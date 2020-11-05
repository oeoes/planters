<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $table = 'farm';
    protected $guarded = [];

    public function afdelling() {
        return $this->hasMany('App\Models\Block', 'afdelling_id', 'id');
    }

    public function rkhrawat() {
        return $this->hasMany('App\Models\Rkhrawat', 'farm_id', 'id');
    }

    public function area() {
        return $this->hasMany('App\Models\Area', 'farm_id', 'id');
    }
}
