<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected $casts = [
        'description' => AsArrayObject::class,
        'price' => 'float',
    ];

    public function templateTypes(): BelongsToMany
    {
        return $this->belongsToMany(TemplateType::class, 'package_template_type')
            ->withPivot('count', 'order')
            ->orderByPivot('order');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function adminBalances(): HasMany
    {
        return $this->hasMany(AdminBalance::class);
    }
}
