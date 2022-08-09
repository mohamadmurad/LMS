<?php

namespace App\Http\Livewire;

use App\Helpers\MainHelper;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubjectReviews extends Component
{

    public $reviews = null;
    public $reviewsCount = 0;

    public $comment;
    public $subject;
    public $stars;

    protected $rules = [
        'comment' => 'required|string',
        'stars' => 'required|min:0.5|max:5',
    ];

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
        $this->reviews = $subject->reviews()->get();
        $this->reviewsCount = $subject->reviews()->count();
    }


    public function render()
    {
        return view('livewire.subject-reviews');
    }

    public function submit()
    {
        $this->validate();


        $this->subject->reviews()->create([
            'student_id' => Auth::id(),
            'comment' => $this->comment,
            'stars' => $this->stars,
        ]);
        $this->comment = null;
        $this->stars = null;
        $this->reviews = $this->subject->reviews()->get();
        $this->reviewsCount = $this->subject->reviews()->count();

        $user = Auth::user();
        (new MainHelper)->notify_user([
            'user_id' => $this->subject->creator_id,
            'message' => "Student $user->name has been review subject " . $this->subject->name,
            'url' => "http://example.com",
            'methods' => ['database']
        ]);
        $this->emitTo('subject-rate', 'refreshComponent');
    }
}
