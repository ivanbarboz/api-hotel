<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "address"=>$this->address,
            "price"=>$this->price,
            "roomType"=>$this->roomType,
            "phoneNumber"=>$this->phoneNumber,
            "departments"=>$this->department->name,
            'photos' => $this->photos->map(function ($photo){
                return [
                    'id' => $photo->id,
                    'uri' => $photo->uri,
                ];
            }),
        ];
    }
}
