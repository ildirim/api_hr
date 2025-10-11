<?php

namespace App\Http\Enums;

enum TimingEnum: int
{
    case ALL = 6001;
    case QUESTION_BASE = 6002;
    case CATEGORY_BASE = 6003;
    case TEMPLATE_BASE = 6004;
}
