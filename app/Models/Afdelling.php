<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afdelling extends Model
{
    use HasFactory;

    protected $table = 'afdellings';
    protected $guarded = [];

    public function assistant () {
        return $this->hasOne(Assistant::class);
    }

    public function farm () {
        return $this->belongsTo(Farm::class);
    }

    public function foreman () {
        return $this->hasMany(Foreman::class);
    }

    public function subforeman () {
        return $this->hasMany(Subforeman::class);
    }
}
