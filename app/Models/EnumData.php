<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnumData extends Model
{
    use HasFactory;

    protected $table = 'enum_datas';

    protected $fillable = [
        'enum_type_id',
        'name',
        'code',
    ];

    public function enumType(): BelongsTo
    {
        return $this->belongsTo(EnumType::class, 'enum_type_id', 'id');
    }
}
