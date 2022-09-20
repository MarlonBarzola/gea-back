<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'reason' => $this->reason,
            'personal_history' => $this->personal_history,
            'family_history' => $this->family_history,
            'vital_signs' => $this->vital_signs,
            'created_at' => $this->created_at,
            'patient' => PatientResource::make($this->whenLoaded('patient'))
        ];
    }
}
