<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockReference extends Model
{
    use HasFactory;

    protected $table = 'block_references';
    protected $guarded = [];
}
