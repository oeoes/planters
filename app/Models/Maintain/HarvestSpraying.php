<?php

namespace App\Models\Maintain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarvestSpraying extends Model
{
    use HasFactory;

    protected $table = 'harvest_spraying';
    protected $guarded = [];
}
