<?php

namespace App\Http\Requests\api\Auth;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;


class LoginRequest extends FormRequest
{
    use ValidationRequest;

    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
 
            $rules = [
                'name' => 'required',
                'password' => 'required',
            ];
            if (is_numeric(request()->email)) {
                $rules['name'] = 'required|numeric';
            }
            if (filter_var(request()->email, FILTER_VALIDATE_EMAIL)) {
                $rules['name'] = 'required';
            }
            return $rules;
     
    }
}
