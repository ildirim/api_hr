<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemplateCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'question_category_id',
        'is_grouped',
        'duration',
        'status_code',
        'name',
        'url',
    ];

    public $timestamps = false;

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(
            Question::class,
            'template_category_questions',
            'template_category_id',
            'question_id',
        );
    }

    public function customQuestions(): BelongsToMany
    {
        return $this->belongsToMany(
            CustomQuestion::class,
            'template_category_questions',
            'template_category_id',
            'custom_question_id',
        );
    }
}
