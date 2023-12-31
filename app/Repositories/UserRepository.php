<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function all():array
    {
       return User::all()->toArray();
    }   

    public function find(int $id):User
    {
        return User::find($id);
    }

    public function create(array $request): User
    {
        $data = array_merge($request, ['status' => 1]);
        return User::create($data);
    }

    public function edit(int $id):User
    {
        return $this->find($id);
    }

    public function update(int $id, $request):User
    {
        $post = $this->find($id);

        $input = $request->validated();

        $post->update($input);

        return $post;
    }


    public function delete(int $id):bool
    {
        $post = $this->find($id);

        return $post->delete();
    }


}
