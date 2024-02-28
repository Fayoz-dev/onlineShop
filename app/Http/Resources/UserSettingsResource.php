<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'settings' => $this->setting,
          'value' => $this->value,
          'switch' => $this->switch === null ? null : (bool) $this->switch
        ];
    }
}
