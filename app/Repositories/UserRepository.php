<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements BaseRepository
{
   // protected $model;

    public function __construct(User $user)
    {
        //$this->model = $user;
    }

    public function all($role)
    {
        return User::role($role)->paginate();
    }

    public function create(array $data, $role)
    {
        $user = User::create($data);
        $user->syncRoles([$role]);

        return $user;

    }

    public function update(array $data, $user)
    {
        $user->update($data);
    }

    public function delete($user)
    {
        $user->delete();
    }

    public function find($id)
    {
    }
}
