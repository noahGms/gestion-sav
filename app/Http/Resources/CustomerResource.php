<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile1' => $this->mobile1,
            'mobile2' => $this->mobile2,
            'address' => AddressResource::make(optional($this->address)),
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
