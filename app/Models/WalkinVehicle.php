<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalkinVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'party_id',
        'vehicle_number',
        'vehicle_type_id',
        'unit_id',
        'in_time',
        'out_time',
        'spent_time'
    ];
}
