<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = [
        'name',
        'total_population',
        'municipality_id',
        'male',
        'female',
        'voter_male',
        'voter_female',
        'total_voter',
    ];


    public function municipalities(){
        return $this->belongsTo(Municipality::class,'municipality_id');
    }
}
