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
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'roles' => $this->roles->pluck('name'),
            'email' => $this->email,
            'status' => $this->status === 1 ? 'active' : 'inactive',
            'image' => asset('categoryImages/' . $this->image),
        ];
    }
}
