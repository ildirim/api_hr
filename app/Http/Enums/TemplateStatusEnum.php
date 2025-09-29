<?php

namespace App\Http\Enums;

enum TemplateStatusEnum: int
{
    case INCOMPLETED_STEP1 = 7001;
    case INCOMPLETED_STEP2 = 7002;
    case INCOMPLETED_STEP3 = 7003;
    case DRAFT = 7004;
    case ACTIVE = 7005;
    case INACTIVE = 7006;
    case EXPIRED = 7007;
}
