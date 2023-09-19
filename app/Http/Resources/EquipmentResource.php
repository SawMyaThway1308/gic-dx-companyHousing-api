<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
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
            'equipment_id' => $this->id,
            'equipment_name' => $this->equipment_name,
            'purchase_year' => $this->purchase_year, 
            'maker' => $this->maker, 
            'model' => $this->model, 
            'status' => $this->status, 
            'address_id' => $this->address_id,
            'address' => $this->address?->address,
            'registration_date' => $this->registration_date, 
            'registration_time' => $this->registration_time 
        ];
    }
}
