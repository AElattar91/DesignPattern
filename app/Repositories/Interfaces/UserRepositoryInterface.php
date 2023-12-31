<?php

namespace App\Repositories\Interfaces;

use App\Models\User;



interface UserRepositoryInterface
{
    public function all():array;
    
    public function find(int $id): User;

    public function create(array $request): User;

    public function edit(int $id): User;

    public function update(int $id, $request): User;

    public function delete(int $id): bool;


}