<?php

namespace App\Http\Requests\api\Auth;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    use ValidationRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,id,'.auth()->user()->id,
            'password' => 'nullable',
            'confirm_password' => 'nullable|same:password',

        ];
    }
}
