<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['configuration_id', 'price', 'start_date', 'end_date'];

    protected $casts = [
        'price' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function configuration()
    {
        return $this->belongsTo(Configuration::class);
    }
}
