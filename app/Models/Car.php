<?php

namespace App\Models;

use App\Models\Configuration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Car extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function configurations()
    {
        return $this->hasMany(Configuration::class);
    }
}
