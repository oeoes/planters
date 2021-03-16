<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $table = 'agencies';
    protected $guarded = [];

    public function companies () {
        return $this->hasMany(Company::class);
    }

    public function getNameAttribute ($value) {
        return ucwords($value);
    }
}
