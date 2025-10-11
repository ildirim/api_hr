<?php

namespace App\Http\Enums;

enum PassingTypeEnum: int
{
    case ALL = 8001;
    case CORRECT_ANSWERS_COUNT = 8002;
    case PERCENTAGE = 8003;
}
