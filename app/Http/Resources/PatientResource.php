<?php

namespace App\Http\Resources;

use App\Models\History;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'dni' => $this->dni,
            'email' => $this->email,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'histories' => HistoryResource::collection($this->whenLoaded('histories')),
            'history_count' => History::where('patient_id', $this->id)->count()
        ];
    }
}
