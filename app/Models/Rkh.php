<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rkh extends Model
{
    use HasFactory;

    protected $table = 'rkh';
    protected $guarded = [];

    public function farm() {
        return $this->belongsTo('App\Models\Farm');
    }

    public function afdelling() {
        return $this->belongsTo('App\Models\Afdelling');
    }

    public function block() {
        return $this->belongsTo('App\Models\Block');
    }
}
