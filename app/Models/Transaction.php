<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'package_id',
        'operation_number',
        'gateway_order',
        'gateway_password',
        'gateway_code',
        'amount',
        'currency',
        'type',
        'status',
        'response',
    ];

    protected $casts = [
        'response' => 'array',
        'amount' => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function adminBalances(): HasMany
    {
        return $this->hasMany(AdminBalance::class);
    }
}
