<?php

namespace App\Models\Harvesting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeHarvesting extends Model
{
    use HasFactory;

    protected $table = 'employee_harvestings';
    protected $guarded = [];
}
