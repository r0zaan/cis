<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
   protected $fillable=[
       'name',
       'province_id'
   ];


    public function municipalities(){
        return $this->hasMany(Municipality::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
}
