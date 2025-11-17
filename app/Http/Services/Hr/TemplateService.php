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
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryStoreDto;
use App\Http\Enums\TemplateStatusEnum;
use App\Http\Enums\TemplateStepEnum;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Interfaces\Hr\Template\TemplateServiceInterface;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use App\Models\Admin;
use App\Models\TemplateCategory;
use App\Notifications\TemplateStatusUpdatedDB;
use App\Notifications\TemplateStatusUpdatedEmail;
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
        return TemplateByIdResponseDto::from($template);
    }

    private function sendEmailNotification(Admin $admin, string $templateName, string $stepName): void
    {
        $message = __("Your template :templateName has been updated. The template is now :stepName.", ['templateName' => $templateName, 'stepName' => $stepName]);
        $admin->notify(new TemplateStatusUpdatedEmail($message));
    }

    private function storeNotification(Admin $admin, string $templateName, string $stepName): void
    {
        $admin->notifyNow(new TemplateStatusUpdatedDB($templateName, $stepName));
    }

    public function store(TemplateStoreDto $templateStoreDto): TemplateByIdResponseDto
    {
        if (!$templateStoreDto->companyId) {
            throw new NotFoundException('Company not found');
        }
        $template = $this->templateRepository->store($templateStoreDto);
        $template->load('admin');

//        #ToDO supervisor elave edilecek. notifyNow -> notify olacaq ve supervisor elave edilecek
        $this->storeNotification($template->admin, $template->name, TemplateStepEnum::STEP1_CREATION->name);
//        $this->sendEmailNotification($template->admin, $template->name, TemplateStepEnum::STEP1_CREATION->name);

        return TemplateByIdResponseDto::from($template);
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

            $this->storeNotification($template->admin, $template->name, TemplateStepEnum::STEP2_QUESTIONS->name);
//        $this->sendEmailNotification($template->admin, $template->name, TemplateStepEnum::STEP2_QUESTIONS->name);
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

        $this->storeNotification($template->admin, $template->name, TemplateStepEnum::STEP3_CONFIGURATION->name);
//        $this->sendEmailNotification($template->admin, $template->name, TemplateStepEnum::STEP2_QUESTIONS->name);
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

        $this->storeNotification($template->admin, $template->name, $templateUpdateDto->status);
//        $this->sendEmailNotification($template->admin, $template->name, TemplateStepEnum::STEP2_QUESTIONS->name);
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
