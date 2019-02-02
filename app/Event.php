<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   protected $fillable=[
       'title','description','time','venue','organiser'
   ];
   
   public function Users()
   {
       return $this->belongsTo('App\User');
   }
}

