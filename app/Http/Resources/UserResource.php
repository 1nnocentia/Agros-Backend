<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'wa_verified' => $this->wa_verified,

            'kelompok_tani' => $this->kelompokTani->nama ?? null,
            'role' => $this->role->role_name ?? 'Petani',
            'isActive' => $this->isActive,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
