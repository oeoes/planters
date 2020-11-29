<?php

namespace App\Models\Maintain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillPruning extends Model
{
    use HasFactory;

    protected $table = 'fill_prunings';
    protected $guarded = [];

}
