<?php

namespace App\Http\Enums;

enum PasswordResetTypeEnum: int
{
    case EMAIL = 3001;
    case PHONE = 3002;
}
