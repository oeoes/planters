<?php

namespace App\Models\Maintain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RkhMaintain extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'id';

    public $incrementing = false;

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
