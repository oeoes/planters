<?php

namespace App\Models\Maintain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillSpraying extends Model
{
    use HasFactory;

    protected $table = 'fill_sprayings';
    protected $guarded = [];
    protected $casts = [
        'hk_name' => 'array'
    ];
}
