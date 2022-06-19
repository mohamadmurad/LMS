<?php

namespace App\Events;

use App\Models\BadgeRule;
use App\Models\BadgeRuleUser;
use App\Models\Behavior;
use App\Models\Exam;
use App\Models\Placement;
use App\Models\Rules;
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
use Illuminate\Validation\Rule;

class placement_complete extends baseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subject $subject, Placement $placement)
    {
        $user = Auth::user();
        $placement_complete = Behavior::where('name', 'placement_complete')->first();
        $points = $placement_complete->placement_points($placement->id);
        $this->rewardPoints($user,$points,$subject->id);

        event(new BadgeGift($subject,'placement_complete'));

        event(new changeLevel($subject));



//
//
//        event(new changeLevel($subject));


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
