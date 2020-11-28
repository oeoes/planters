<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfdellingReference extends Model
{
    use HasFactory;

    protected $table = 'afdelling_references';
    protected $guarded = [];
}
