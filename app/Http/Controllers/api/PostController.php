<?php

namespace App\Http\Controllers\api;
use App\Models\Post;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\AllPostResource;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\ShowPostResource;
use App\Http\Resources\api\User\UserResource;
use App\Repositories\Interfaces\PostRepositoryInterface;


class PostController extends Controller
{
    private PostRepositoryInterface $repository;
    /**
     * Display a listing of the resource.
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function index()
    {
        $user_id = auth()->user('sanctum')->id;
        $posts = $this->repository->all($user_id);
        $this->body['cards'] = AllPostResource::collection($posts);

        return response()->json(['data'=>$this->body, 'error'=>''], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $validate = $request->validated();
        
        $user_id = auth()->user('sanctum')->id;
        $post = $this->repository->create($user_id, $request->except('image'));

        $image = $post->addMedia($request->file('image'))
                      ->toMediaCollection('posts');
        $image->save();

        $this->message = __('post Add successfully');
        return response()->json(['data'=>$this->message, 'error'=>''], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id,$slug):JsonResponse
    {
        $posts = $this->repository->show($id,$slug);

        $this->body['cards'] = ShowPostResource::make($posts);

        return response()->json(['data'=>$this->body, 'error'=>''], 200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
