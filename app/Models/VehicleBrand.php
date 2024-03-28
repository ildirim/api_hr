<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    protected $guarded = [];
    public function vehicleModels()
    {
        return $this->hasMany(VehicleModel::class);
    }
}