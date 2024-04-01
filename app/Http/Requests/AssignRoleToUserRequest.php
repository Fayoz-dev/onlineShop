<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignRoleToUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('role:assign');
    }

    public function rules(): array
    {
        return [
            "user_id" => "required",
            "role_id" => "required"
        ];
    }
}
