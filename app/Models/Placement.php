<?php

namespace App\Models;

use App\Traits\HasPoints;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Placement extends Model
{
    use HasFactory,HasPoints;

    protected $fillable = [
        'name',
        'subject_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'placement_questions', 'placement_id', 'question_id')
            ->withTimestamps();
            //->using(PlacementQuestion::class);
    }

    public function submit(){
        return $this->hasMany(PlacementSubmit::class, 'placement_id', 'id')
            ->with('answers');
    }
    public function authSubmit()
    {
        return $this->submit()
            ->where('student_id', Auth::id())
           ;
    }

    public function userSubmit($id)
    {

        return $this->submit()
            ->where('student_id', $id);


    }


}
