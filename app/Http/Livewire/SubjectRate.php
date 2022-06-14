<?php

namespace App\Http\Livewire;

use App\Models\Subject;
use Livewire\Component;

class SubjectRate extends Component
{


    /**
     * @var Subject
     */
    public $subject;
    /**
     * @var mixed
     */
    public $stars;

    // component-a
    protected $listeners = [
        'refreshComponent' => 'refreshComponent1'
    ];

    public function refreshComponent1(){

        $this->stars = floor($this->subject->reviews()->avg('stars'));
    }

    public function mount(Subject $subject)
    {

        $this->subject = $subject;
        $this->stars = floor($subject->reviews()->avg('stars'));


    }

    public function render()
    {
        return view('livewire.subject-rate');
    }
}
