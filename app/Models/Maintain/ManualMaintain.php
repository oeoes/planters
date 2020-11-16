<?php

namespace App\Models\Maintain;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualMaintain extends Model
{
    use HasFactory;

    protected $table = 'manual_maintains';
    protected $guarded = [];
}
