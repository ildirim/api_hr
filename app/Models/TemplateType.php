<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemplateType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'has_system_questions',
        'max_system_question_count',
        'max_custom_question_count',
        'passing_type_code',
        'timing_code',
        'has_shuffling',
        'has_shuffle_questions',
        'max_shuffled_question_count',
        'status',
    ];

    public function templates(): HasMany
    {
        return $this->hasMany(Template::class);
    }

    public function questionCategories(): BelongsToMany
    {
        return $this->belongsToMany(QuestionCategory::class, 'template_type_question_category')
            ->withPivot('max_question_count')
            ->withTimestamps();
    }
}



