<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $table = 'block';
    protected $guarded = [];

    public function afdelling() {
        return $this->belongsTo('App\Models\Afdelling');
    }

    public function area() {
        return $this->hasMany('App\Models\Area', 'block_id', 'id');
    }

    public function rkh() {
        return $this->hasMany('App\Models\Rkh', 'block_id', 'id');
    }


}
