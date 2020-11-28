<?php

namespace App\Models\Maintain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruningType extends Model
{
    use HasFactory;

    protected $table = 'prunings';
    protected $guarded = [];
}
