<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TemplateCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'duration',
        'order_number',
    ];

    public $timestamps = false;

    public function questions(): MorphToMany
    {
        return $this->morphedByMany(
            Question::class,
            'questionable',
            'template_category_questions',
            'template_category_id',
            'questionable_id'
        )->withPivot(['duration', 'order_number']);
    }

    public function customQuestions(): BelongsToMany
    {
        return $this->morphedByMany(
            CustomQuestion::class,
            'questionable',
            'template_category_questions',
            'template_category_id',
            'questionable_id'
        )->withPivot(['duration', 'order_number']);
    }
}
