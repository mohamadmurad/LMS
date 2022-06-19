<?php

namespace App\Http\Livewire;

use App\Models\Badge;
use App\Models\Subject;
use Livewire\Component;

class CreatePlacementForm extends Component
{

    public $subjects;

    public $modules = [];
    public $x = null;
    public $badges;

    public function mount($subjects)
    {

        $this->subjects = $subjects;
        $this->badges = Badge::all();

        $this->x = $this->subjects[0]->id;
       // $this->questions = $this->subjects[0]->questions()->get();
        $this->modules =  $this->subjects[0]->modules()->get();
    }

    public function updatedX()
    {

        $subject = Subject::findOrFail($this->x);

        $this->modules = $subject->modules()->get();
    }

    public function render()
    {
        return view('livewire.create-placement-form');
    }

    public function ch($id)
    {
        dd('ds');
    }


}
