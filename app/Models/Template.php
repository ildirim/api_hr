<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'company_id',
        'language_id',
        'job_subcategory_id',
        'plan_type_id',
        'duration',
        'timing_code',
        'name',
        'url',
        'status',
    ];

    public function templateCategories(): HasMany
    {
        return $this->hasMany(TemplateCategory::class, 'template_id', 'id');
    }
}
