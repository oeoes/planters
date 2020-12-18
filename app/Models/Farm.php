<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function manager () {
        return $this->hasOne(FarmManager::class);
    }

    public function company () {
        return $this->belongsTo(Company::class);
    }

}
