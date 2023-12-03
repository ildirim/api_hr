<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerTranslation extends Model
{
    public $table = 'answer_translations';
    public $fillable = ['answer_id', 'language_id', 'name'];
    public $timestamps = false;
}
