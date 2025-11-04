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
}
