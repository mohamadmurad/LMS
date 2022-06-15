<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id',
        'module_id',
    ];


    public function module(){
        return $this->belongsTo(Module::class,'module_id','id');
    }
    public function questions(){
        return $this->belongsToMany(Question::class,'exam_questions','exam_id','question_id')
            ->withTimestamps()
            ->using(ExamQuestion::class);
    }
}
