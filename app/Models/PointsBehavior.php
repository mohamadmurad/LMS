<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsBehavior extends Model
{
    use HasFactory;


    public function point(){
        return $this->belongsTo(Points::class,'point_id','id');
    }
}
