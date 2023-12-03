<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['question_id', 'is_correct'];

    public function translations(): HasMany
    {
        return $this->hasMany(AnswerTranslation::class, 'answer_id', 'id');
    }
}
