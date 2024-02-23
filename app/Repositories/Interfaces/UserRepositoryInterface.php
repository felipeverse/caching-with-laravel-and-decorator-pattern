<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {
    public function all();
    public function allWithPostCount();
    public function findOrFail($id);
    public function create($input);
    public function destroy($id);
}
