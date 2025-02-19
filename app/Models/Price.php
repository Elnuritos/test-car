<?php

namespace App\Models;

use App\Models\Configuration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    public $timestamps = false;

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
