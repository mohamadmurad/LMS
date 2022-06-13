<?php

namespace App\Events;

use App\Models\Behavior;
use App\Models\Objective;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class objective_complete extends baseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user,Objective $objective,Subject $subject)
    {
        $objective_complete = Behavior::where('name', 'objective_complete')->first();
        $points = $objective_complete->objective_points($objective->id);
        foreach ($points as $point) {

            $user->rewardPoints()->UpdateOrCreate([
                'points_behaviors_id' => $point->pivot->id,
            ], [
                'points_behaviors_id' => $point->pivot->id,
                'count' => $point->count,
            ]);

            $this->pointSession('You are Reward ' . $point->count . ' Points');
        }

       // event(new changeLevel($subject));

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
