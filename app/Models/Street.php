<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path(){
        return "/calles/$this->id";
    }

    public function houses(){

        return $this->hasMany("App\Models\House");


    }


    public function addHouse($number){

        return $this->houses()->create(["number" => $number]);


    }


}
