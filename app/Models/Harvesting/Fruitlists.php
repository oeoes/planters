<?php

namespace App\Models\Harvesting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruitlists extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'fruit_list';
}
