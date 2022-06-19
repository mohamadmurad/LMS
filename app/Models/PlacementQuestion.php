<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'placement_id',
        'question_id',
    ];
}
