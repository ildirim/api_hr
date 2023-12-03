<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategoryTranslation extends Model
{
    public $table = 'job_category_translations';
    public $fillable = ['job_category_id', 'language_id', 'name'];
    public $timestamps = false;
}
