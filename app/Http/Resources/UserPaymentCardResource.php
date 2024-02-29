<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPaymentCardResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'card_type' => $this->type,
            'number' => '******'. decrypt($this->last_four_number),
            'name' => decrypt($this->name),
        ];
    }
}
