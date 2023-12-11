<?php

namespace App\Http\Enums;

enum AdminStatusEnum: int
{
    case PENDING = 1001;
    case ACTIVE = 1002;
    case DEACTIVE = 1003;
}
