<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
   protected $fillable =[
       'name',
       'district_id',
       'area',
       'population',
       'total_ward',
       'image',
       'type',
   ];

    public function district(){
        return $this->belongsTo(District::class);
    }
    public function wards(){
        return $this->hasMany(Ward::class,'municipality_id');
    }
}
