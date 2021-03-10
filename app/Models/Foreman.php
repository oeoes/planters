<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Foreman extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'foremans';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getNameAttribute ($value) {
        return ucwords($value);
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'afdelling_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];
}
