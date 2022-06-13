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


}
