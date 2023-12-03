<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionCategoryTranslation extends Model
{
    public $table = 'question_category_translations';
    public $fillable = ['question_category_id', 'language_id', 'name'];
    public $timestamps = false;
}
