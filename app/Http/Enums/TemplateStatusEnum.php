<?php

namespace App\Http\Enums;

enum TemplateStatusEnum: int
{
    case INCOMPLETED_STEP1 = 7001;
    case INCOMPLETED_STEP2 = 7002;
    case DRAFT = 7003;
    case ACTIVE = 7004;
    case INACTIVE = 7005;
    case EXPIRED = 7006;
}
