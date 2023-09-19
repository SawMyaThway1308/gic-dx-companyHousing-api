<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * リソースを配列に変形する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray($request)
    {
        return [
            'address_id' => $this->id,
            'address' => $this->address,
            'type' => $this->type,
            'use_start_date' => $this->use_start_date,
            'rent' => $this->rent,
            'capacity' => $this->capacity,
            'contract_type' => $this->contract_type,
            'status' => $this->status,
            'registration_date' => $this->registration_date,
            'registration_time' => $this->registration_time,
        ];
    }
}
