<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    public $table = 'question_translations';
    public $fillable = ['question_id', 'language_id', 'content'];
    public $timestamps = false;
}
