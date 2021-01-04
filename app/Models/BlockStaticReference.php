<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockStaticReference extends Model
{
    use HasFactory;

    protected $table = 'block_static_references';
    protected $guarded = [];
}
