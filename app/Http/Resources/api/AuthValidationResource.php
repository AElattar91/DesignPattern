<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthValidationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_required' =>  __('api.full_name_required'),
            'email_required' =>  __('api.email_required'),
            'email_check' =>  __('api.check_email'),
            'password_required' => __('api.password_required'),
            'confirm_password_required' => __('api.confirm_password_required'),
            'password_match' => __('api.password_match'),
            'phone_required' => __('api.phone_required'),
 
        ];
    }
}
