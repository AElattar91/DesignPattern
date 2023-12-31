<?php

namespace App\Http\Controllers\api\Auth;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AuthDataResource;
use App\Http\Resources\ProfileDataResource;
use App\Http\Requests\api\Auth\LoginRequest;
use App\Http\Resources\api\User\UserResource;
use App\Http\Requests\api\Auth\RegisterRequest;
use App\Http\Resources\api\AuthValidationResource;
use App\Http\Requests\api\Auth\ProfileUpdateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;


class AuthController extends Controller
{
    //
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login(LoginRequest $request): JsonResponse
    {

        $validate = $request->validated();
        

        if (Auth::attempt($validate)) {
            $user = Auth::user();

            $user->update(['fcm_token' => $request->fcm_token]);

            $this->message = __('api.login_successfully');
            $this->body['user'] = UserResource::make($user);
             $token = $user->createToken($user->name);

             return response()->json(['message'=>$this->message ,'token'=>$token->plainTextToken,'user'=>$this->body, 'error'=>''], 200);
        } else {

            $this->message = __('api.auth_failed');
            return response()->json(['message'=>$this->message , 'error'=>''], 200);
        }


    }


    public function register (RegisterRequest $request):JsonResponse
    {
        $validate = $request->validated();
        $User = $this->repository->create($request->validated());


        if($User){

            $this->message = __('api.Register_successfully');


            $User->update(['fcm_token' => $request->fcm_token]);

            $this->body['user'] = UserResource::make($User);
             $token = $User->createToken($User->name);

             return response()->json(['message'=>$this->message ,'token'=>$token->plainTextToken,'user'=>$this->body, 'error'=>''], 200);


        }elseif(!$User){

            $this->message = __('api.Bade_Register');
            return response()->json(['message'=>$this->message , 'error'=>''], 200);
        }


    }

    public function Profile()
    {
 
     
        $user = auth()->user('sanctum');
       
        $this->body['Data'] = UserResource::make($user);

        return response()->json(['data'=>$this->body, 'error'=>''], 200);
    }

    public function edit_profile(ProfileUpdateRequest $request)
    {

        $validate = $request->validated();
        $user = auth()->user('sanctum');
        $user->update($request->except('password'));
        
        if ($request->password != null){
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->save();
        
        $this->body['user'] = UserResource::make($user);
        $this->message = __('update profile successfully');

        return response()->json(['data'=>$this->message, 'error'=>''], 200);
    }

 
  

}
