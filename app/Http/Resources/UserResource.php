<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'settings' => UserSettingsResource::collection($this->settings),
            'created_at' => $this->created_at,
            'photo' => $this->photos()->exists() ? Storage::url($this->photos()->first()->path) : null,
            'roles' => $this->getRoleNames()
        ];
    }
}
