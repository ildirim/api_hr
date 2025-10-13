<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionCategory extends Model
{
    use HasFactory;

    public $table = 'question_categories';
    public $fillable = [''];

    public function translations(): HasMany
    {
        return $this->hasMany(QuestionCategoryTranslation::class, 'question_category_id', 'id');
    }

    public function templateTypes(): BelongsToMany
    {
        return $this->belongsToMany(TemplateType::class, 'template_type_question_category')
            ->withPivot('max_question_count')
            ->withTimestamps();
    }
}
