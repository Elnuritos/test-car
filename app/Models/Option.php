<?php

namespace App\Models;

use App\Models\Configuration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function configurations()
    {
        return $this->belongsToMany(Configuration::class, 'configuration_option');
    }
}
