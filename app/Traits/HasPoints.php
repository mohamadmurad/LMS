<?php


namespace App\Traits;


use App\Models\Points;

trait HasPoints{

    public static function bootHasPoints(){
        static::deleting(function ($model){
            $model->points()->delete();
        });
    }

    public function points(){

        return $this->morphMany(Points::class,'model','model_type','model_id');
    }

}
