<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = "persons";

    public function house(){
        return $this->belongsTo("App\Models\House");
    }

    public function path(){
        return "/persona/$this->id";
    }

    public function personVaccinations(){
        return $this->hasMany("App\Models\PersonVaccination");
    }
    



}
