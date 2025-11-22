<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\Enums\TemplateStatusEnum;
use App\Http\Enums\TemplateStepEnum;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use App\Http\DTOs\CoreData;

class TemplateStoreDto extends CoreData
{
    #[Computed]
    public ?int $adminId = null;

    #[Computed]
    public ?int $companyId = null;

    public int $currentStep = TemplateStepEnum::STEP1_CREATION->value;
    public int $status = TemplateStatusEnum::DRAFT->value;

    public function __construct(
        #[Exists('job_subcategories', 'id')]
        public int $jobSubcategoryId,

        #[Exists('template_types', 'id')]
        public int $templateTypeId,

        #[Exists('languages', 'id')]
        public int $languageId,

        #[Min(3)]
        #[Max(100)]
        public string $name,
    ) {
        $admin = auth('admin')->user();
        $this->adminId = $admin->id;
        $this->companyId = $admin->company_id;
    }

    public static function messages(): array
    {
        return [
            'jobSubcategoryId.required' => 'Kateqoriya daxil edin',
            'jobSubcategoryId.integer' => 'Kateqoriya rəqəm tipi olmalıdır',
            'jobSubcategoryId.exists' => 'Kateqoriya mövcud deyil',
            'jobSubcategoryId.between' => 'Kateqoriya maksimal 11 simvol ola bilər',
            'languageId.required' => 'Dil daxil edin',
            'languageId.integer' => 'Dil rəqəm tipi olmalıdır',
            'languageId.exists' => 'Dil mövcud deyil',
            'languageId.between' => 'Dil maksimal 11 simvol ola bilər',
            'planTypeId.required' => 'Dil daxil edin',
            'planTypeId.integer' => 'Dil rəqəm tipi olmalıdır',
            'planTypeId.exists' => 'Dil mövcud deyil',
            'planTypeId.between' => 'Dil maksimal 11 simvol ola bilər',
            'name.required' => 'Şablon adı daxil edin',
            'name.string' => 'Şablon adı yazı tipi olmalıdır',
            'name.between' => 'Şablon adı maksimal 100 simvol ola bilər',
            'timingCode.required' => 'Vaxt seçimi daxil edin',
            'timingCode.integer' => 'Vaxt seçimi rəqəm tipi olmalıdır',
            'timingCode.between' => 'Vaxt seçimi kodu düzgün daxil edilməyib',
            'duration.integer' => 'Müddət rəqəm tipi olmalıdır',
            'duration.between' => 'Müddət seçimi  düzgün daxil edilməyib',
        ];
    }
}
