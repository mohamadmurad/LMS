<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function errorFlash($msg='Error'){
        Session::flash('error',$msg);
    }

    public function successFlash($msg='Success !'){
        Session::flash('success',$msg);
    }

    public function infoFlash($msg='Info !'){
        Session::flash('info',$msg);
    }
}
