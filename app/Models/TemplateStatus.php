<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemplateStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'admin_id',
        'status_code',
    ];
}
