<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DomainCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            " domain"=>$this->domain_name,
            'link_for_events_of_a_specific_domian'=>route('events.domain_specific',$this->domain_name)
        ];
    }
}
