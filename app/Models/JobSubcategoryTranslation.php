<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSubcategoryTranslation extends Model
{
    public $table = 'job_subcategory_translations';
    public $fillable = ['job_subcategory_id', 'language_id', 'name'];
    public $timestamps = false;
}
