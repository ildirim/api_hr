<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'transaction_id',
        'package_id',
        'template_type_id',
        'total_count',
        'used_count',
    ];

    protected $casts = [
        'total_count' => 'integer',
        'used_count' => 'integer',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function templateType(): BelongsTo
    {
        return $this->belongsTo(TemplateType::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get remaining balance
     */
    public function getRemainingAttribute(): int
    {
        return $this->total_count - $this->used_count;
    }
}
