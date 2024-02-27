<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rating' => $this->rating,
            'user' => $this->user->first_name,
            'product' => $this->prodct_id,
            'body' => $this->body,
            'date' => $this->created_at
        ];
    }
}
