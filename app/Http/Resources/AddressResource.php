<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'street_number' => $this->street_number,
            'street_name' => $this->street_name,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
