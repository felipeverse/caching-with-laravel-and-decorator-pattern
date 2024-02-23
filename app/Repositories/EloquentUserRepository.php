<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface {

    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function allWithPostCount()
    {
        return $this->model->withCount('posts')->get();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($input)
    {
        $user = new $this->model;

        $user->name = $input['name'];
        $user->position = $input['position'];
        $user->email = $input['email'];
        $user->password = Hash::make('password');
        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $user = $this->model->findOrFail($id);
        $user->delete();
    }
}
