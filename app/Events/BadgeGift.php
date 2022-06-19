<?php

namespace App\Events;

use App\Models\BadgeBehavior;
use App\Models\BadgeRule;
use App\Models\BadgeRuleUser;
use App\Models\Behavior;
use App\Models\Levels;
use App\Models\RewardBadge;
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

class BadgeGift extends baseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subject $subject, $event)
    {
        $behavior = Behavior::where('name', $event)->first();
        if ($behavior) {
            $badge = BadgeBehavior::where('behavior_id', $behavior->id)
                ->where('subject_id', $subject->id)
                ->with('badge')->first();

            if ($badge) {

                RewardBadge::create([
                    'user_id' => Auth::id(),
                    'subject_id' =>$subject->id,
                    'badge_id' => $badge->badge_id,
                ]);

                $this->pointSession('You are Reward ' . $badge->badge->name . ' badge');
            }
        }
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
