<?php

namespace App\Models\Harvesting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingHarvesting extends Model
{
    use HasFactory;

    protected $table = 'grading_harvestings';
    protected $guarded = [] ;
}
