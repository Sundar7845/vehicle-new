<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'short_name',
        'is_active',
    ];
    /**
     * The admins that belong to the site.
     */
    public function admins()
    {
        return $this->belongsToMany(User::class, 'admin_sites', 'site_id', 'user_id');
    }
}
