<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobCategory extends Model
{
    use HasFactory;

    public $table = 'job_categories';
    public $fillable = [''];

    public function translations(): HasMany
    {
        return $this->hasMany(JobCategoryTranslation::class, 'job_category_id', 'id');
    }
}
