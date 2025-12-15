<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'site_id'
    ];
}
