<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignmentSubmitObjectives extends Model
{
    use HasFactory;

    protected $fillable = [
        'objective_id',
        'submit_id',
        'subject_id',
        'is_achieved',
    ];

    public function objective(){
        return $this->belongsTo(Objective::class,'objective_id','id');
    }

    public function submit(){
        return $this->belongsTo(AssignmentSubmit::class,'submit_id','id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
