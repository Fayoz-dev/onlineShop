<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'photo' => 'nullable|file|mimes:jpg,bmp,png|file|max:10000',
            'first_name' => 'nullable',
            'last_name' => 'nullable'
        ];
    }
}
