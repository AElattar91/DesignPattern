<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;


class PostRepository implements PostRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function all($user_id)
    {
       return Post::query()
                        ->with('User')
                        ->where('user_id', '<>', $user_id)
                        ->orderBy('id', 'ASC')
                        ->get();
    }

    public function show(int $id, $slug)
    {
        $post= Post::query()->where('id', $id)->with('User')->first();
        $post->getFirstMedia('media');
        return $post;
    }

    public function find(int $id):Post
    {
        return Post::find($id);
    }

    public function create(int $user_id, array $request): Post
    {
        $data = array_merge($request, ['user_id' => $user_id]);
        return Post::create($data);
        
    }

    public function edit(int $id):Post
    {
        return $this->find($id);
    }

    public function update(int $id, $request):Post
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
