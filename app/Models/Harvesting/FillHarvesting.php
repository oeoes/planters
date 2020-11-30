<?php

namespace App\Models\Harvesting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillHarvesting extends Model
{
    use HasFactory;

    protected $table = 'fill_harvestings';
    protected $guarded = [];
}
