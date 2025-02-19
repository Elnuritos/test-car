<?php

namespace App\Models;

use App\Models\Configuration;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationOption extends Model
{
    use HasFactory;
    protected $table = 'configuration_option';

    protected $fillable = ['configuration_id', 'option_id'];

    public $timestamps = false;

    public function configuration()
    {
        return $this->belongsTo(Configuration::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
