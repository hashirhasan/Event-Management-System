<?php

namespace App\Http\Resources;

use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            "user_id"=>$this->user_id,
            "title"=> $this->title,
            "image"=>$this->image,
            "description"=>$this->description,
            "time"=> $this->time,
            "venue"=>$this->venue,
            "organiser"=>$this->organiser
         

        ];
    }
    

}
