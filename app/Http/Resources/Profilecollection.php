<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Profilecollection extends JsonResource
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
            'organisation'=>$this->organisation,
            'link'=>[
                'profile'=>route('organisations.show',$this->id)
            ]
            
        ];
    }
}
