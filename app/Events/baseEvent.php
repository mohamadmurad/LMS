<?php

namespace App\Events;

use App\Models\Enroll;
use App\Models\User;
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


    public function rewardPoints(User $user,$points,$subject_id){

        foreach ($points as $point) {

            $user->rewardPoints()->UpdateOrCreate([
                'point_id' => $point->id,
                'subject_id'=> $subject_id
            ], [
                'point_id' => $point->id,
                'count' => $point->count,
                'subject_id'=> $subject_id
            ]);
            $enroll = Enroll::where('student_id',$user->id)->where('subject_id',$subject_id)->first();

            Enroll::where('student_id',$user->id)->where('subject_id',$subject_id)->update([
                'points'=>$enroll->points + $point->count
            ]);


            $this->pointSession('You are Reward ' . $point->count . ' Points');
        }
    }


}
