<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPaymentCardRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "name" => "required",
            "number" => "required",
            "exp_date" => "required",
            "holder_name" => "required",
            "payment_card_type_id" => "required"
        ];
    }
}
