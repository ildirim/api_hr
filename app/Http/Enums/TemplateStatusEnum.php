<?php

namespace App\Http\Enums;

enum TemplateStatusEnum: int
{
    case INCOMPLETED = 7001;
    case DRAFT = 7002;
    case ACTIVE = 7003;
    case INACTIVE = 7004;
    case EXPIRED = 7005;
}
