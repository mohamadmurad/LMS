<?php
namespace App\Helpers;
use App\Models\MenuLink;
use Illuminate\Support\Facades\Notification;
class MainHelper {

    protected static $lowerLimit = 70;
    protected static $upperLimit = 255;
    protected static $colorGap = 20;
    protected static $generated = array();

    public static function notify_user(
        $options=[]
    ){
        $options = array_merge([
            'user_id'=>1,
            'content'=>[],
            'action_url'=>"",
            'methods'=>['database'],
            'image'=>"",
            'btn_text'=>"عرض الإشعار"
        ],$options);
        $user = \App\Models\User::where('id',$options['user_id'])->first();
        if($user!=null){
            \App\Models\User::where('email', $user->email )->first()->notify(
                new \App\Notifications\GeneralNotification([
                    'content'=>$options['content'],
                    'action_url'=>$options['action_url'],
                    'btn_text'=>$options['btn_text'],
                    'methods'=>$options['methods'],
                    'message'=>$options['message'],
                    'image'=>$options['image']
                ])
            );
        }
    }


    public static function notify_visitors(
        $options=[]
    ){

        $options = array_merge([
            'emails'=>["admin@admin.com"],
            'content'=>[],
            'action_url'=>"",
            'methods'=>['mail'],
            'image'=>"",
            'btn_text'=>"عرض الإشعار"
        ],$options);

        dd($options['emails']);
         Notification::route('mail', $options['emails'])
                ->notify(new \App\Notifications\GeneralNotification([
                    'content'=>$options['content'],
                    'action_url'=>$options['action_url'],
                    'btn_text'=>$options['btn_text'],
                    'methods'=>$options['methods'],
                    'image'=>$options['image']
                ]));
    }



    public static function slug($string){
        $t = $string;
        $specChars = array(
            ' ' => '-',    '!' => '',    '"' => '',
            '#' => '',    '$' => '',    '%' => '',
            '&amp;' => '','&nbsp;' => '',
            '\'' => '',   '(' => '',
            ')' => '',    '*' => '',    '+' => '',
            ',' => '',    '₹' => '',    '.' => '',
            '/-' => '',    ':' => '',    ';' => '',
            '<' => '',    '=' => '',    '>' => '',
            '?' => '',    '@' => '',    '[' => '',
            '\\' => '',   ']' => '',    '^' => '',
            '_' => '',    '`' => '',    '{' => '',
            '|' => '',    '}' => '',    '~' => '',
            '-----' => '-',    '----' => '-',    '---' => '-',
            '/' => '',    '--' => '-',   '/_' => '-',
        );
        foreach ($specChars as $k => $v) {
            $t = str_replace($k, $v, $t);
        }

        return substr($t,0,230);
    }




}
