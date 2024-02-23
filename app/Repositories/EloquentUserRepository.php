<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Interfaces\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface {

    /**
     * @var User
     */
    private $model;

    /**
     * Tempo padrão de expiração do cache em segundos.
     */
    private const DEFAULT_CACHE_TTL = 30;

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
        return Cache::tags('users')->remember('all', self::DEFAULT_CACHE_TTL, function () {
            return $this->model->all();
        });
    }

    /**
     * Retorna todos os usuários com a contagem de posts associados.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allWithPostCount()
    {
        return Cache::tags('users')->remember('allWithPostCount', self::DEFAULT_CACHE_TTL, function () {
            return $this->model->withCount('posts')->get();
        });
    }

    /**
     * Encontra um usuário pelo ID ou lança uma exceção se não encontrado.
     *
     * @param  int  $id - ID do usuário.
     * @return User
     */
    public function findOrFail($id)
    {
        return Cache::tags('users')->remember($id, self::DEFAULT_CACHE_TTL, function () use ($id) {
            return $this->model->findOrFail($id);
        });
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

        Cache::tags('users')->flush();
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
        Cache::tags('users')->flush();
    }
}
