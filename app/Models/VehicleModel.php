<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $guarded = [];
    public function vehicleBrand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }
}