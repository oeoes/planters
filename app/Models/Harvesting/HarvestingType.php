<?php

namespace App\Models\Harvesting;;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarvestingType extends Model
{
    use HasFactory;

    protected $table = 'harvestings';
    protected $guarded = [];
}
