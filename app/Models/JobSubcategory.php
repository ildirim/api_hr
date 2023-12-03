<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobSubcategory extends Model
{
    use HasFactory;

    public $table = 'job_subcategories';
    protected $fillable = ['job_category_id'];

    public function translations(): HasMany
    {
        return $this->hasMany(JobSubcategoryTranslation::class, 'job_subcategory_id', 'id');
    }
}
