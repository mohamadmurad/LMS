<?php

namespace App\Events;

use App\Models\Behavior;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class enroll_subject extends baseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $subject)
    {
        $enroll_subject = Behavior::where('name', 'enroll_subject')->first();
        //$pointsCount = $subject->points ? $subject->points->count : null;
        $points = $enroll_subject->subject_points($subject->id);

        foreach ($points as $point) {

            $user->rewardPoints()->UpdateOrCreate([
                'points_behaviors_id' => $point->pivot->id,
            ], [
                'points_behaviors_id' => $point->pivot->id,
                'count' => $point->count,
            ]);

            $this->pointSession('You are Reward ' . $point->count . ' Points');
        }


        // event(new BadgeGift($subject, 'enroll_subject'));
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
