<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $userInfo = [
            'id'             => 1,
            'first_name'           => 'Admin',
            'last_name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       =>  Hash::make('password'),
            'remember_token' => null,
        ];


        $user = User::create($userInfo);

        $user->assignrole('admin');

        $userInfo = [
            'id'             => 2,
            'first_name'           => 'Teacher',
            'last_name'           => '1',
            'email'          => 'teacher1@admin.com',
            'password'       =>  Hash::make('password'),
            'remember_token' => null,
        ];

        $user = User::create($userInfo);

        $user->assignrole('teacher');
        $userInfo = [
            'id'             => 3,
            'first_name'           => 'student',
            'last_name'           => '1',
            'email'          => 'student1@admin.com',
            'password'       =>  Hash::make('password'),
            'remember_token' => null,
        ];
        $user = User::create($userInfo);

        $user->assignrole('student');

    }
}
