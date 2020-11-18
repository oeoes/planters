<?php

namespace App\Models\Harvesting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PalmHarvesting extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'palms';
}
