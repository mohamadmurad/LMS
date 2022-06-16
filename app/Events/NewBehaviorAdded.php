<?php

namespace App\Events;


use App\Models\RewardBadge;
use App\Models\RewardPoint;
use App\Models\StudentBehavior;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewBehaviorAdded extends baseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StudentBehavior $studentBehavior)
    {
        $subject = $studentBehavior->subject;
        $behavior = $studentBehavior->behavior;
        $student = $studentBehavior->student;
        $badgesBehaviors = $behavior->badges()->where('subject_id',$subject->id)->get();
        foreach ($badgesBehaviors as $badgesBehavior){
            RewardBadge::create([
                'user_id' => $student->id,
                'badge_id' => $badgesBehavior->badge->id,
                'subject_id' => $subject->id,
            ]);
        }

        $points = $behavior->behaviorPoints()->where('subject_id',$subject->id)->get();
        foreach ($points as $point){

            RewardPoint::create([
                'point_id' => $point->id,
                'student_id' => $student->id,
                'subject_id' => $subject->id,
            ]);
        }

        event(new changeLevel($subject));
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
