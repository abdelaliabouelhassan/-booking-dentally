<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ConvestionCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'appointment_start_date'=> Carbon::createFromFormat('Y-m-d H:i:s', $this->appointment_start_date)->format('D m/d/Y'),
            'patient_first_name'=>$this->patient_first_name,
            'patient_last_name'=>$this->patient_last_name,
            'practitioner_image'=>$this->practitioner_image,
            'practitioner_name'=>$this->practitioner_name,
            'tco'=> $this->tco_id ? $this->tco->role : 'None',
            'conveted_by'=> $this->converted_by_id ? $this->converted_by->role : 'None',
            'outcome'=> $this->outcome,
            'called_by'=> $this->called_day_before_id ? $this->called_by->role : 'None',
            'value' => $this->value ? '£' .  $this->value : '-',
        ];
    }
}
