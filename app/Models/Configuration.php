<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['car_id', 'name'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'configuration_option');
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
