<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'phone',
        'email',
        'password',
        'otp',
        'otp_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The sites that belong to the user (Admin).
     */
    public function sites()
    {
        return $this->belongsToMany(Site::class, 'admin_sites', 'user_id', 'site_id');
    }

    /**
     * Check if user has access to a specific site.
     */
    public function hasAccessToSite($siteId)
    {
        // If role is 1 (Admin), check pivot. 
        // If role is 2 (Site User), check site_id column (legacy/direct).
        if ($this->role_id == 1) {
            return $this->sites->contains('id', $siteId);
        }
        return $this->site_id == $siteId;
    }
}
