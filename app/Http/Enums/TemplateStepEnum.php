<?php

namespace App\Http\Enums;

enum TemplateStepEnum: int
{
    case STEP1_CREATION = 7001;
    case STEP2_QUESTIONS = 7002;
    case STEP3_CONFIGURATION = 7003;
    case STEP4_DRAFT = 7004;
    case STEP5_COMPLETED = 7005;
    case STEP6_ACTIVE = 7006;



    public static function getNameById(?int $id): ?string {
        return match ($id) {
            TemplateStepEnum::STEP1_CREATION->value => TemplateStepEnum::STEP1_CREATION->name,
            TemplateStepEnum::STEP2_QUESTIONS->value => TemplateStepEnum::STEP2_QUESTIONS->name,
            TemplateStepEnum::STEP3_CONFIGURATION->value => TemplateStepEnum::STEP3_CONFIGURATION->name,
            TemplateStepEnum::STEP4_DRAFT->value => TemplateStepEnum::STEP4_DRAFT->name,
            TemplateStepEnum::STEP5_COMPLETED->value => TemplateStepEnum::STEP5_COMPLETED->name,
            TemplateStepEnum::STEP6_ACTIVE->value => TemplateStepEnum::STEP6_ACTIVE->name,

            default => null
        };
    }
}
