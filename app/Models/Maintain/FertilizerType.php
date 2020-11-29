<?php

namespace App\Models\Maintain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizerType extends Model
{
    use HasFactory;

    protected $table = 'fertilizers';
    protected $guarded = [];
}
