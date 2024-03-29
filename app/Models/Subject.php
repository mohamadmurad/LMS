<?php

namespace App\Models;

use App\Traits\HasPoints;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Subject extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait, HasPoints;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        self::deleting(function (Subject $subject) {
            if ($subject->hasMedia('cover')) {
                $subject->getFirstMedia('cover')->delete();
            }

            $subject->modules()->each(function ($module) {
                $module->delete();
            });

        });
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'creator_id',
    ];

    protected $appends = ['is_completed','mark'];


    public function getIsCompletedAttribute(){
        foreach ($this->modules as $module){
           if (!$module->is_completed){
               return false;
           }
        }
        return true;
    }

    public function getMarkAttribute(){
        $modulesCount = $this->modules()->count();
        $mark = 0;
        foreach ($this->modules as $module){
          $mark+= $module->mark;
        }
        if($modulesCount == 0) return  null;

        return floor($mark / $modulesCount);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'subject_id', 'id');
    }

    public function enrolledStudents()
    {
        return $this->belongsToMany(User::class, 'enrolls', 'subject_id', 'student_id')->withPivot('level_id','points')

            ->join('levels', 'levels.id', '=', 'level_id')
            ->select(['users.*', 'levels.name as level_name','enrolls.points as points'])
            ->withTimestamps();
    }


    public function authEnrolledStudent()
    {
        return $this->belongsToMany(User::class, 'enrolls', 'subject_id', 'student_id')
            ->withPivot('level_id')
            ->withTimestamps()->where('student_id', Auth::id())->first();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'subject_id', 'id')
            ->with('student')
            ->orderBy('id', 'DESC');
    }

    public function assignments(){
        return $this->hasMany(Assignment::class,'subject_id','id');
    }


    public function questions(){
        return $this->hasMany(Question::class,'subject_id','id');
    }


    public function exams(){
        return $this->hasMany(Exam::class,'subject_id','id');
    }

   public function placement(){
        return $this->hasOne(Placement::class,'subject_id','id');
    }


    public function levels(){
        return $this->belongsToMany(Level::class,'subject_levels','subject_id','level_id')
            ->using(SubjectLevel::class)
            ->withPivot('point')
            ->withTimestamps()
            ->orderBy('pivot_point', 'asc');
    }

    public function getLeaderBoard($start,$end){
        return RewardPoint::with(['student', 'point'])
            ->where('reward_points.subject_id', $this->id)
            ->whereBetween('reward_points.created_at',[$start,$end])
           // ->join('users', 'reward_points.student_id', '=', 'users.id')
            ->join('points', 'reward_points.point_id', '=', 'points.id')
//            ->join('enrolls', 'reward_points.student_id', '=', 'enrolls.student_id')
//            ->join('levels', 'reward_points.student_id', '=', 'enrolls.student_id')
            ->select( DB::raw('SUM(points.count) as points'), 'reward_points.student_id')
            ->groupBy('reward_points.student_id')
            ->orderBy('points','desc')
            ->get();
    }




    public function notAchievedObjective(){
        return $this->hasMany(assignmentSubmitObjectives::class,'subject_id','id')
            ->where('is_achieved',0)->get();
    }


    public function authCert(){
        $record = $this->hasMany(certificates::class,'subject_id','id')->where('student_id',Auth::id())->first();

        if ($record){
            return $record->file;

        }
        return null;

    }
}
