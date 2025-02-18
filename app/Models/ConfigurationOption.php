<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationOption extends Model
{
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
