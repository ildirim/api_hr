<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAnswer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'custom_question_id',
        'is_correct',
        'name',
    ];
}
