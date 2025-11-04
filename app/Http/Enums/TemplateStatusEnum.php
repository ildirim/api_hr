<?php

namespace App\Http\Enums;

enum TemplateStatusEnum: int
{
    case DRAFT = 9001;
    case COMPLETED = 9002;
    case ACTIVE = 9003;
    case INACTIVE = 9004;
    case EXPIRED = 9005;
}
