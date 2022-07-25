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
    public $count = 0;

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





        if ($this->level == 0) {
            // easy 90%
            $basic = floor(90 * $this->count / 100);
        } elseif ($this->level == 1) {
            // medium 70%
            $basic = floor(70 * $this->count / 100);
        } else {
            // hard 50%
            $basic = floor(50 * $this->count / 100);
        }

        $advanced = $this->count - $basic;


//        $this->questions = $this->subject->questions()->whereHas('objective',function ($query){
//            $query->where('module_id',$this->x);
//        })->where('level',$this->level)->get();

   // dd($advanced);
        $questionsIDsBasic = $this->subject->questions()->whereHas('objective', function ($query) {
            $query->where('module_id', $this->x);
        })->where('level', 0)->inRandomOrder()->limit($basic)->pluck('id');


        $questionsIDsAdvanced = $this->subject->questions()->whereHas('objective', function ($query)  {
            $query->where('module_id', $this->x);
        })->where('level', 1)->inRandomOrder()->limit($advanced)->pluck('id');


        $this->max = count($questionsIDsBasic) + count($questionsIDsAdvanced);
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
