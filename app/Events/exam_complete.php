<?php

namespace App\Events;

use App\Models\Behavior;
use App\Models\Exam;
use App\Models\Module;
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

class exam_complete extends baseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subject $subject, Exam $exam)
    {

        $user = Auth::user();
        $exam_complete = Behavior::where('name', 'exam_complete')->first();

        $points = $exam_complete->exam_points($exam->id);
        $this->rewardPoints($user, $points, $subject->id);

        event(new changeLevel($subject));

        //event(new BadgeGift($module->subject, 'exam_complete'));
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
