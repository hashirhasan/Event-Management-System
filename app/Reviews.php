<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable=[
        'name','student_no','star','review'
    ];

    public function events()
    {
        return $this->belongsTo('App\Event');
    }
}
