<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_subcategory_id',
        'question_category_id',
        'question_level',
        'period',
    ];

    public function scopeQuestionCategory(Builder $query, ?int $questionCategory): void
    {
        if ($questionCategory) {
            $query->where('question_category_id', $questionCategory);
        }
    }

    public function scopeLevel(Builder $query, ?int $level): void
    {
        if ($level) {
            $query->where('question_level', $level);
        }
    }

    public function scopeJobSubcategory(Builder $query, ?int $jobSubcategory): void
    {
        if ($jobSubcategory) {
            $query->where('job_subcategory_id', $jobSubcategory);
        }
    }

    public function translations(): HasMany
    {
        return $this->hasMany(QuestionTranslation::class, 'question_id', 'id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
