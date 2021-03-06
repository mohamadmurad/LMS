<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birthDate',
        'email',
        'password',
        'is_verified',
        'gender',
        'school',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }


    public function enrolledSubject()
    {
        return $this->belongsToMany(Subject::class, 'enrolls', 'student_id', 'subject_id')
            ->withPivot('level_id')
            ->using(Enroll::class)
            ->withTimestamps();
    }

    public function seen()
    {
        return $this->belongsToMany(Objective::class, 'objective_seen', 'student_id', 'objective_id')
            ->withTimestamps();
    }


    public function rewardPoints()
    {
        return $this->hasMany(RewardPoint::class, 'student_id', 'id');
    }

    public function rewardBadges()
    {
        return $this->hasMany(RewardBadge::class, 'user_id', 'id');
    }

    public function rewardBadgesSubject($id)
    {
        return $this->rewardBadges()
            ->where('subject_id', $id)->with('badge');
    }

    public function rewardPointsSubject($id)
    {
        return $this->rewardPoints()
            ->where('subject_id', $id)->with('point.pointReason');
    }

    public function enrolledSubjectId($id)
    {
        return $this->enrolledSubject()->where('subject_id', $id)->first();
    }

    public function totalPoints($subject_id)
    {
        return $this->rewardPointsSubject($subject_id)->withSum('point', 'count')->get()->sum('point_sum_count');
    }
    public function totalPoint()
    {
        return $this->rewardPoints()->withSum('point', 'count');
    }

    public function getLevel($subject_id)
    {
        return $this->enrolledSubject()->where('subject_id', $subject_id)->first();
    }

    public function getLevelId($subject_id)
    {

        return $this->getLevel($subject_id)->pivot->level_id;
    }


    public function exam_submit()
    {
        return $this->belongsToMany(Exam::class, 'exam_submits', 'student_id', 'exam_id')
            ->withPivot(['final_mark'])
            ->join('exam_submit_answers', 'exam_submits_id', '=', 'exam_submits.id')
            ->withTimestamps();
    }

    public function subject_exam_submit($subject_id)
    {
        return $this->exam_submit()->where('subject_id', $subject_id)->get();
    }

    public function placement_submit()
    {
        return $this->belongsToMany(Placement::class, 'placement_submits', 'student_id', 'placement_id')
            ->join('placement_submit_answers', 'placement_submits_id', '=', 'placement_submits.id')
            ->withTimestamps();
    }

    public function subject_placement_submit($subject_id)
    {

        return $this->placement_submit()->where('subject_id', $subject_id)->first();
    }


}
