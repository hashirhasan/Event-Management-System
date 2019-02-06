<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            'leader_name'=>$this->leader_name,
            'domain_name'=>$this->domain_name,
            'organisation'=>$this->organisation,
            'email'=>$this->email,
            'total_events'=>$this->events->count(),
            'link'=>[
                'show_all_events'=>route('events.view',$this->id),
                'show_upcoming_events'=>route('events.upcoming_of_specific_organisation',$this->id),
                'show_passed-away_events'=>route('events.passed_of_specific_organisation',$this->id),
            ]
        ];
    }
}
