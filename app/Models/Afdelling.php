<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afdelling extends Model
{
    use HasFactory;

    protected $table = 'afdelling';
    protected $guarded = [];

    public function rkhrawat() {
        return $this->hasMany('App\Models\Rkhrawat', 'afdelling_id', 'id');
    }

    public function area() {
        return $this->hasMany('App\Models\Area', 'afdelling_id', 'id');
    }
}
