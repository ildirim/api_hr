<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'admin_id' => $this->admin_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'image' => $this->image,
            'address' => $this->address,
            'website' => $this->website,
            'about' => $this->about,
            'created_at' => $this->created_at,
        ];
    }
}
