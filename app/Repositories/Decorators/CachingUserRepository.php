<?php

namespace App\Repositories\Decorators;

use Illuminate\Contracts\Cache\Repository as Cache;
use App\Repositories\Interfaces\UserRepositoryInterface;

class CachingUserRepository implements UserRepositoryInterface {

    /**
     * Repositório base a ser decorado.
     *
     * @var App\Repositories\Interfaces\UserRepositoryInterface;
     */
    protected $repository;

    /**
     * Cache utilizado para armazenar os resultados.
     *
     * @var Illuminate\Support\Facades\Cache
     */
    protected $cache;

    /**
     * Tempo padrão de expiração do cache em segundos.
     */
    private const DEFAULT_CACHE_TTL = 30;

    /**
     * Construtor da classe.
     *
     * @param UserRepositoryInterface $repository - Repositório base a ser decorado.
     * @param Cache $cache - Cache utilizado para armazenar os resultados.
     */
    public function __construct(UserRepositoryInterface $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    /**
     * Retorna todos os usuários com caching.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->cache->tags('users')->remember('all', self::DEFAULT_CACHE_TTL, function () {
            return $this->repository->all();
        });
    }

    /**
     * Retorna todos os usuários com contagem de posts, utilizando caching.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allWithPostCount()
    {
        return $this->cache->tags('users')->remember('allWithPostCount', self::DEFAULT_CACHE_TTL, function () {
            return $this->repository->allWithPostCount();
        });
    }

    /**
     * Encontra um usuário pelo ID com caching.
     *
     * @param int $id - ID do usuário.
     * @return User
     */
    public function findOrFail($id)
    {
        return $this->cache->tags('users')->remember($id, self::DEFAULT_CACHE_TTL, function () use ($id) {
            return $this->repository->findOrFail($id);
        });
    }

    /**
     * Cria um novo usuário e limpa o cache.
     *
     * @param array $input - Dados do novo usuário.
     * @return User
     */
    public function create($input)
    {
        $this->cache->tags('users')->flush();
        return $this->repository->create($input);
    }

    /**
     * Remove um usuário e limpa o cache.
     *
     * @param int $id
     * @return null
     */
    public function destroy($id)
    {
        $this->cache->tags('users')->flush();
        return $this->repository->destroy($id);
    }
}
