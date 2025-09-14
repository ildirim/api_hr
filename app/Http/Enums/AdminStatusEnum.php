<?php

namespace App\Http\Enums;

enum AdminStatusEnum: int
{
    case PENDING = 2001;
    case ACTIVE = 2002;
    case INACTIVE = 2003;
}
