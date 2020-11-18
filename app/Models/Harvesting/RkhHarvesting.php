<?php

namespace App\Models\Harvesting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RkhHarvesting extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'rkh_harvestings';

    public $incrementing = false;

}
