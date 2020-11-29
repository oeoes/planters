<?php

namespace App\Models\Maintain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SprayingType extends Model
{
    use HasFactory;

    protected $table = 'sprayings';
    protected $guarded = [];

    protected $casts = [
        'block_ref_id' => 'integer',
        'foreman_id' => 'integer',
        'subforeman_id' => 'integer',
    ];
}
