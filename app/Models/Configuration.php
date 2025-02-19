<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Option;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
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
