<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'id'    => 2,
                'name' => 'teacher',
                'guard_name' => 'web',
            ],
            [
                'id'    => 3,
                'name' => 'student',
                'guard_name' => 'web',
            ],
        ];

        Role::insert($roles);
    }
}
