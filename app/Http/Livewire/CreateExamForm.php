<?php

namespace App\Http\Livewire;

use App\Models\Subject;
use Livewire\Component;

class CreateExamForm extends Component
{

    public $modules;
    public $subject;
    public $questions = [];
    public $x  = null;
    public $level = 0;
    public $max = 0;

    public function mount(Subject  $subject)
    {
        $this->subject = $subject;
        $this->modules = $this->subject->modules;
        $this->x = $this->modules[0]->id;
        $this->questions = $this->subject->questions()->whereHas('objective',function ($query){
            $query->where('module_id',$this->x);
        })->where('level',$this->level)->get();
        $this->max = count($this->questions);
    }
    public function updatedX()
    {

        $this->questions = $this->subject->questions()->whereHas('objective',function ($query){
            $query->where('module_id',$this->x);
        })->get();
    }
    public function updatedLevel()
    {

        $this->questions = $this->subject->questions()->whereHas('objective',function ($query){
            $query->where('module_id',$this->x);
        })->where('level',$this->level)->get();
        $this->max = count($this->questions);
    }
    public function render()
    {
        return view('livewire.create-exam-form');
    }
    public function ch($id)
    {
       dd('ds');
    }


}
