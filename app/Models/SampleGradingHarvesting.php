<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleGradingHarvesting extends Model
{
    use HasFactory;

    protected $table = 'sample_grading_harvestings';
    protected $guarded = [];
}
