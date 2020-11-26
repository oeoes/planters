<?php

namespace App\Models\Maintain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SprayingType extends Model
{
    use HasFactory;

    protected $table = 'sprayings';
    protected $guarded = [];
}
