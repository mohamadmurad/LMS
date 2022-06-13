<?php

namespace Database\Seeders;

use App\Models\Behavior;
use App\Models\Category;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BehaviorsTableSeeder extends Seeder
{
    public function run()
    {
        Behavior::create([
            'name' => 'progress_complete',
//            'notification_title' => 'progress_point',
//            'notification_body' => 'progress_point',
        ]);
        Behavior::create([
            'name' => 'exam_complete',
//            'notification_title' => 'exam_complete',
//            'notification_body' => 'exam_complete',
        ]);
        Behavior::create([
            'name' => 'exam_fail',
//            'notification_title' => 'exam_fail',
//            'notification_body' => 'exam_fail',
        ]);

        Behavior::create([
            'name' => 'placement_complete',
//            'notification_title' => 'placement_complete',
//            'notification_body' => 'placement_complete',
        ]);
        Behavior::create([
            'name' => 'placement_fail',
//            'notification_title' => 'placement_fail',
//            'notification_body' => 'placement_fail',
        ]);

        Behavior::create([
            'name' => 'objective_complete',
//            'notification_title' => 'objective_complete',
//            'notification_body' => 'objective_complete',
        ]);
        Behavior::create([
            'name' => 'enroll_subject',
//            'notification_title' => 'enroll_subject',
//            'notification_body' => 'enroll_subject',
        ]);
        Behavior::create([
            'name' => 'module_complete',
//            'notification_title' => 'module_complete',
//            'notification_body' => 'module_complete',
        ]);

        Behavior::create([
            'name' => 'subject_complete',
//            'notification_title' => 'subject_complete',
//            'notification_body' => 'subject_complete',
        ]);


    }
}
