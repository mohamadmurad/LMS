<?php

namespace App\Events;

use Illuminate\Support\Facades\Session;

class baseEvent
{


    public function pointSession($msg){
        if (Session::has('points')){
            Session::flash('points',array_merge(Session::get('points'),[$msg]));
        }else{
            Session::flash('points',[$msg]);
        }

    }


    public function rewardPoints($user,$points,$subject_id){

        foreach ($points as $point) {

            $user->rewardPoints()->UpdateOrCreate([
                'point_id' => $point->id,
                'subject_id'=> $subject_id
            ], [
                'point_id' => $point->id,
                'count' => $point->count,
                'subject_id'=> $subject_id
            ]);

            $this->pointSession('You are Reward ' . $point->count . ' Points');
        }
    }


}
