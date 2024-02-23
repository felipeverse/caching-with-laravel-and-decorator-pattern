<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface {

    /**
     * @var User
     */
    private $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Retorna todos os usuários.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Retorna todos os usuários com a contagem de posts associados.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allWithPostCount()
    {
        return $this->model->withCount('posts')->get();
    }

    /**
     * Encontra um usuário pelo ID ou lança uma exceção se não encontrado.
     *
     * @param  int  $id - ID do usuário.
     * @return User
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Cria um novo usuário com base nos dados fornecidos.
     *
     * @param  array  $input - Dados do novo usuário.
     * @return User
     */
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

    /**
     * Remove um usuário pelo ID.
     *
     * @param  int  $id - ID do usuário a ser removido.
     * @return void
     */
    public function destroy($id)
    {
        $user = $this->model->findOrFail($id);
        $user->delete();
        return null;
    }
}
