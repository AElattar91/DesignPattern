<?php

namespace App\Support\Traits;

trait ValidationRequest
{
    public function authorize()
    {
        return true;
    }

    public function messagesAction(): array
    {
        return [];
    }

    public function messages($array = []): array
    {

        return array_merge(
            [
                'email_required' =>  __('front.email_required'),
                'email_unique'  => __('The email has already been taken.'),
                'password_required' => __('front.password_required'),
                'confirm_password_required' => __('front.confirm_password_required'),
                'phone_required' => __('front.phone_required'),

            ], $this->messagesAction());
    }
}
