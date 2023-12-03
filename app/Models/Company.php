<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $table = 'companies';
    protected $fillable = [
        'admin_id',
        'name',
        'phone',
        'image',
        'address',
        'website',
        'about',
        'status',
    ];
}
