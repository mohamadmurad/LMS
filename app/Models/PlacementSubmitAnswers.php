<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlacementSubmitAnswers extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'placement_submits_id',
        'question_id',
        'option_id',
        'correct',
    ];

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'option_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function submit()
    {
        return $this->belongsTo(PlacementSubmit::class, 'placement_submits_id', 'id');
    }
}
