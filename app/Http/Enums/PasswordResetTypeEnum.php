<?php

namespace App\Http\Enums;

enum PasswordResetTypeEnum: int
{
    case EMAIL = 1001;
    case PHONE = 1002;
}
