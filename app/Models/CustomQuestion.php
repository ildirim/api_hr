<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class CustomQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'template_id',
        'language_id',
        'content',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(CustomAnswer::class, 'custom_question_id', 'id');
    }
}
