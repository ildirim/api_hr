<?php

namespace App\Http\Enums;

enum QuestionTypeEnum: int
{
    case TEXT = 1;
    case NUMBER = 2;
    case DATE = 3;
    case SINGLE_CHOICE = 4;
    case MULTIPLE_CHOICE = 5;
    case BOOLEAN = 6;
}
