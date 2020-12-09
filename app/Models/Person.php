<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = "persons";

    protected $guarded = [];

    public function house(){
        return $this->belongsTo("App\Models\House");
    }

    public function path(){
        return "/personas/$this->id";
    }

    public function personVaccinations(){
        return $this->hasMany("App\Models\PersonVaccination");
    }
    



}
