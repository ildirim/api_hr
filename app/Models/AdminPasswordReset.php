<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminPasswordReset extends Model
{
    use HasFactory;

    protected $table = 'admin_password_reset';

    protected $fillable = [
        'admin_id',
        'token',
        'target',
        'otp_code',
        'expired_at',
        'confirmed_at',
        'completed_at',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
