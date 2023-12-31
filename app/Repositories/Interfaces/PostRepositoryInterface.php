<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;



interface PostRepositoryInterface
{
    public function all($user_id);
    
    public function show(int $id, $slug);

    public function find(int $id): Post;

    public function create(int $user_id, array $request): Post;

    public function edit(int $id): Post;

    public function update(int $id, $request): Post;

    public function delete(int $id): bool;
}