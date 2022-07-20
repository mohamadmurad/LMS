<?php

namespace App\Events;

use App\Models\Levels;
use App\Models\Subject;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class changeLevel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subject $subject,$user = null)
    {
        if ($user == null){
            $user= Auth::user();
        }
        $totalPoints = $user->totalPoints($subject->id);
        $authLevelID = $user->getLevelId($subject->id);

        $authLevel = $subject->levels()->where('levels.id', $authLevelID)->first();
        $levels = $subject->levels()->get();




        $temp_level = null;
        foreach ($levels as $nL) {

            if ($totalPoints > $nL->pivot->point) {
                $temp_level = $nL;
                continue;
            }
            break;
        }



        if ($temp_level && $temp_level->id != $authLevelID) {
            $user->enrolledSubject()->syncWithoutDetaching([
                $subject->id => [
                    'level_id' => $temp_level->id,
                ]
            ]);
            Session::flash('level', 'Your level has increased to  ' . $temp_level->name);
        }


//
//
//        $authLevelPoints = $authLevel->pivot->point;
//        if ($nextLevel) {
//            $nextLevelPoints = $nextLevel->pivot->point;
//
//            if ($totalPoints >= $nextLevelPoints) {
//
//                Auth::user()->enrolledSubject()->syncWithoutDetaching([
//                    $subject->id => [
//                        'level_id' => $nextLevel->id,
//                    ]
//                ]);
//
//                Session::flash('level', 'Your level has increased to  ' . $nextLevel->name);
//            }
//        }


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
