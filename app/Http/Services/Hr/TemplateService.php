<?php

namespace App\Http\Services\Hr;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Http\DTOs\Hr\Template\Request\TemplateCategoryRequestDto;
use App\Http\DTOs\Hr\Template\Request\TemplateQuestionDto;
use App\Http\DTOs\Hr\Template\Request\TemplateSettingDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreUpdateDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;
use App\Http\DTOs\Hr\Template\Response\TemplateListResponseDto;
use App\Http\DTOs\Hr\TemplateCategory\Response\TemplateCategoryByIdResponseDto;
use App\Http\DTOs\Hr\TemplateQuestion\Response\TemplateQuestionResponseDto;
use App\Http\DTOs\Hr\Answer\Response\AnswerResponseDto;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryStoreDto;
use App\Http\Enums\TemplateStatusEnum;
use App\Http\Enums\TemplateStepEnum;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Interfaces\Hr\Template\TemplateServiceInterface;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use App\Models\TemplateCategory;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\PaginatedDataCollection;


class TemplateService implements TemplateServiceInterface
{
    public function __construct(
        protected TemplateRepositoryInterface $templateRepository,
        protected TemplateCategoryRepositoryInterface $templateCategoryRepository,
    )
    {
    }

    public function getTemplatesByCompanyId(): ?PaginatedDataCollection
    {
        $companyId = auth('admin')->user()->company_id;
        if (!$companyId) {
            throw new NotFoundException('Company not found');
        }
        $templates = $this->templateRepository->getTemplatesByCompanyId($companyId);
        return TemplateListResponseDto::collection($templates);
    }

    public function getTemplateById(int $id): ?TemplateByIdResponseDto
    {
        $template = $this->templateRepository->getTemplateDetailsById($id);

        if (!$template) {
            return null;
        }

        $languageId = $template->language_id;
        $templateCategoryCollection = collect($template->templateCategories)
            ->sortBy('order_number')
            ->values();
        $templateCategoryIds = $templateCategoryCollection->pluck('id')->all();

        // Batch: question category names
        $questionCategoryIdSet = $templateCategoryCollection->pluck('question_category_id')->filter()->unique()->all();
        $questionCategoryNames = empty($questionCategoryIdSet)
            ? collect()
            : \DB::table('question_category_translations as qct')
                ->whereIn('qct.question_category_id', $questionCategoryIdSet)
                ->where('qct.language_id', $languageId)
                ->pluck('qct.name', 'qct.question_category_id');

        // All template-category-question rows
        $tcqRows = \DB::table('template_category_questions as tcq')
            ->whereIn('tcq.template_category_id', $templateCategoryIds)
            ->select('tcq.template_category_id', 'tcq.questionable_id', 'tcq.questionable_type', 'tcq.order_number', 'tcq.duration')
            ->orderBy('tcq.order_number')
            ->get();

        // Split by type
        $questionTcq = $tcqRows->where('questionable_type', 'App\\Models\\Question');
        $customQuestionTcq = $tcqRows->where('questionable_type', 'App\\Models\\CustomQuestion');

        // Regular questions data
        $questionIds = $questionTcq->pluck('questionable_id')->unique()->all();
        $questionsData = empty($questionIds)
            ? collect()
            : \DB::table('questions as q')
                ->join('question_translations as qt', 'qt.question_id', '=', 'q.id')
                ->whereIn('q.id', $questionIds)
                ->where('qt.language_id', $languageId)
                ->select('q.id', 'qt.content')
                ->get()
                ->keyBy('id');

        $answersByQuestion = empty($questionIds)
            ? collect()
            : \DB::table('answers as a')
                ->leftJoin('answer_translations as at', 'at.answer_id', '=', 'a.id')
                ->whereIn('a.question_id', $questionIds)
                ->where('at.language_id', $languageId)
                ->select('a.id', 'a.question_id', 'a.is_correct', 'at.name')
                ->get()
                ->groupBy('question_id')
                ->map(function ($rows) {
                    return collect($rows)->map(function ($a) {
                        return AnswerResponseDto::from([
                            'id' => $a->id,
                            'is_correct' => (int) $a->is_correct,
                            'name' => $a->name,
                        ]);
                    });
                });

        // Custom questions data
        $customQuestionIds = $customQuestionTcq->pluck('questionable_id')->unique()->all();
        $customQuestionsData = empty($customQuestionIds)
            ? collect()
            : \DB::table('custom_questions as cq')
                ->whereIn('cq.id', $customQuestionIds)
                ->select('cq.id', 'cq.content')
                ->get()
                ->keyBy('id');

        $customAnswersByQuestion = empty($customQuestionIds)
            ? collect()
            : \DB::table('custom_answers as ca')
                ->whereIn('ca.custom_question_id', $customQuestionIds)
                ->select('ca.id', 'ca.custom_question_id', 'ca.is_correct', 'ca.answer_text')
                ->get()
                ->groupBy('custom_question_id')
                ->map(function ($rows) {
                    return collect($rows)->map(function ($a) {
                        return AnswerResponseDto::from([
                            'id' => $a->id,
                            'is_correct' => (int) $a->is_correct,
                            'name' => $a->answer_text,
                        ]);
                    });
                });

        $formatSeconds = function ($seconds) {
            $seconds = (int) ($seconds ?? 0);
            $h = floor($seconds / 3600);
            $m = floor(($seconds % 3600) / 60);
            $s = $seconds % 60;
            return sprintf('%02d:%02d:%02d', $h, $m, $s);
        };

        $questionsByTc = $tcqRows->groupBy('template_category_id')->map(function ($rows) use (
            $questionsData,
            $answersByQuestion,
            $customQuestionsData,
            $customAnswersByQuestion,
            $formatSeconds,
            $template
        ) {
            return collect($rows)->map(function ($row) use (
                $questionsData,
                $answersByQuestion,
                $customQuestionsData,
                $customAnswersByQuestion,
                $formatSeconds,
                $template
            ) {
                if ($row->questionable_type === 'App\\Models\\Question') {
                    $q = $questionsData->get($row->questionable_id);
                    $answers = $answersByQuestion->get($row->questionable_id, collect());
                    return TemplateQuestionResponseDto::from([
                        'id' => $row->questionable_id,
                        'period' => $formatSeconds($row->duration),
                        'question_category_name' => null,
                        'job_subcategory_name' => $template->job_subcategory_name ?? null,
                        'content' => $q->content ?? null,
                        'answers' => $answers,
                    ]);
                }
                $cq = $customQuestionsData->get($row->questionable_id);
                $answers = $customAnswersByQuestion->get($row->questionable_id, collect());
                return TemplateQuestionResponseDto::from([
                    'id' => $row->questionable_id,
                    'period' => $formatSeconds($row->duration),
                    'question_category_name' => null,
                    'job_subcategory_name' => $template->job_subcategory_name ?? null,
                    'content' => $cq->content ?? null,
                    'answers' => $answers,
                ]);
            });
        });

        $templateCategories = $templateCategoryCollection->map(function ($tc) use ($questionCategoryNames, $questionsByTc) {
            return TemplateCategoryByIdResponseDto::from([
                'question_category_id' => $tc->question_category_id,
                'question_category_name' => $tc->question_category_id ? ($questionCategoryNames[$tc->question_category_id] ?? null) : null,
                'duration' => $tc->duration,
                'order_number' => $tc->order_number,
                'questions' => $questionsByTc->get($tc->id, collect()),
            ]);
        });
        return TemplateByIdResponseDto::from([
            'id' => $template->id,
            'company_id' => $template->company_id,
            'job_subcategory_id' => $template->job_subcategory_id,
            'language_id' => $template->language_id,
            'job_category_id' => $template->job_category_id,
            'name' => $template->name,
            'plan_code' => $template->plan_code ?? null,
            'job_category_name' => $template->job_category_name ?? null,
            'job_subcategory_name' => $template->job_subcategory_name ?? null,
            'language' => $template->language ?? null,
            'template_categories' => collect($templateCategories),
        ]);
    }

    public function store(TemplateStoreDto $templateStoreDto): TemplateByIdResponseDto
    {
        if (!$templateStoreDto->companyId) {
            throw new NotFoundException('Company not found');
        }
        return TemplateByIdResponseDto::from($this->templateRepository->store($templateStoreDto));
    }

    public function storeQuestions(int $id, TemplateQuestionDto $templateQuestionDto): void
    {
        DB::transaction(function () use ($id, $templateQuestionDto) {
            $template = $this->templateRepository->getTemplateById($id);
            if (!$template) {
                throw new NotFoundException();
            }
            if ($template->current_step !== TemplateStepEnum::STEP1_CREATION->value) {
                throw new BadRequestException('Stage is wrong');
            }
            foreach ($templateQuestionDto->templateCategories as $templateCategoryDto) {
                $templateCategory = $this->storeTemplateCategory($id, $templateCategoryDto);

                $questions = collect($templateCategoryDto->questions);
                $this->storeTemplateCategoryQuestions($questions, $templateCategory, $templateCategoryDto->questionCategoryId);
            }

            $templateUpdateDto = TemplateUpdateDto::from([
                'currentStep' => $templateQuestionDto->currentStep,
            ]);
            $this->templateRepository->update($template, $templateUpdateDto);
        });
    }

    public function updateQuestions(int $id, TemplateQuestionDto $templateQuestionDto): void
    {
        DB::transaction(function () use ($id, $templateQuestionDto) {
            $template = $this->templateRepository->getTemplateById($id);
            if (!$template) {
                throw new NotFoundException();
            }
            if (in_array($template->status, [TemplateStatusEnum::COMPLETED->value, TemplateStatusEnum::ACTIVE->value])) {
                throw new BadRequestException('Template can not be updated');
            }
            if ($template->current_step !== TemplateStepEnum::STEP2_QUESTIONS->value) {
                throw new BadRequestException('Stage is wrong');
            }

            // delete existing template categories and their questions
            $template->templateCategories->each(function ($templateCategory) {
                $templateCategory->questions()->detach();
                $templateCategory->customQuestions()->detach();
                $templateCategory->delete();
            });

            // recreate from request
            foreach ($templateQuestionDto->templateCategories as $templateCategoryDto) {
                $templateCategory = $this->storeTemplateCategory($id, $templateCategoryDto);

                $questions = collect($templateCategoryDto->questions);
                $this->storeTemplateCategoryQuestions($questions, $templateCategory, $templateCategoryDto->questionCategoryId);
            }

            $templateUpdateDto = TemplateUpdateDto::from([
                'currentStep' => $templateQuestionDto->currentStep,
            ]);
            $this->templateRepository->update($template, $templateUpdateDto);
        });
    }

    private function storeTemplateCategory(int $templateId, TemplateCategoryRequestDto $templateCategoryDto): TemplateCategory
    {
        $templateCategoryStoreDto = TemplateCategoryStoreDto::from([
            'templateId' => $templateId,
            'questionCategoryId' => $templateCategoryDto->questionCategoryId,
            'duration' => $templateCategoryDto?->duration,
            'orderNumber' => $templateCategoryDto->orderNumber,
        ]);
        return $this->templateCategoryRepository->store($templateCategoryStoreDto);
    }

    private function storeTemplateCategoryQuestions($questions, TemplateCategory $templateCategory, ?int $questionCategoryId): void
    {
        $questionableType = $questionCategoryId
            ? 'App\Models\Question'
            : 'App\Models\CustomQuestion';

        $insertData = $questions->map(function ($q) use ($templateCategory, $questionableType) {
            return [
                'template_category_id' => $templateCategory->id,
                'questionable_id' => $q['id'],
                'questionable_type' => $questionableType,
                'order_number' => $q['orderNumber'] ?? 0,
                'duration' => $q['duration'] ?? 0,
            ];
        })->toArray();

        DB::table('template_category_questions')->insert($insertData);

//        $questionsData = $questions->mapWithKeys(fn ($q) => [
//            $q['id'] => [
//                'order_number' => $q['orderNumber'] ?? 0,
//                'duration' => $q['duration'] ?? 0,
//            ]
//        ])
//            ->toArray();
//        $templateCategory->questions()->attach($questionsData);
    }

    public function storeSettings(int $id, TemplateSettingDto $templateSettingDto): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if (in_array($template->status, [TemplateStatusEnum::COMPLETED->value, TemplateStatusEnum::ACTIVE->value])) {
            throw new BadRequestException('Template can not be updated');
        }
        if ($template->current_step !== TemplateStepEnum::STEP2_QUESTIONS->value) {
            throw new BadRequestException('Stage is wrong');
        }

        $templateUpdateDto = TemplateUpdateDto::from($templateSettingDto->toArray());
        $this->templateRepository->update($template, $templateUpdateDto);
    }

    public function updateSettings(int $id, TemplateSettingDto $templateSettingDto): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if (in_array($template->status, [TemplateStatusEnum::COMPLETED->value, TemplateStatusEnum::ACTIVE->value])) {
            throw new BadRequestException('Template can not be updated');
        }
        if ($template->current_step !== TemplateStepEnum::STEP3_CONFIGURATION->value) {
            throw new BadRequestException('Stage is wrong');
        }

        $templateUpdateDto = TemplateUpdateDto::from($templateSettingDto->toArray());
        $this->templateRepository->update($template, $templateUpdateDto);
    }

    public function update(int $id, TemplateUpdateDto $templateUpdateDto): void
    {
        if (
            !in_array(
                $templateUpdateDto->currentStep,
                [TemplateStepEnum::STEP4_DRAFT->value, TemplateStepEnum::STEP5_COMPLETED->value, TemplateStepEnum::STEP6_ACTIVE->value])
        ) {
            throw new BadRequestException('Step is not correct');
        }
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if ($template->current_step !== TemplateStepEnum::STEP3_CONFIGURATION->value) {
            throw new BadRequestException('Stage is wrong');
        }
        $this->templateRepository->update($template, $templateUpdateDto);
    }

    public function updateStore(int $id, TemplateStoreUpdateDto $templateStoreUpdateDto): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if (in_array($template->status, [TemplateStatusEnum::COMPLETED->value, TemplateStatusEnum::ACTIVE->value])) {
            throw new BadRequestException('Template can not be updated');
        }
//        if ($template->current_step > TemplateStepEnum::STEP3_CONFIGURATION->value) {
//            throw new BadRequestException('Stage is wrong');
//        }
        $this->templateRepository->updateStore($template, $templateStoreUpdateDto);
    }

    public function destroy(int $id): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        $this->templateRepository->destroy($template);
    }
}
