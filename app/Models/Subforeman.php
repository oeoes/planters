<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subforeman extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'subforemans';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];
}
