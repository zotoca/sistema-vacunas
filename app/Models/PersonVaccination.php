<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonVaccination extends Model
{
    use HasFactory;


    protected $table = "person_vaccination";

    protected $guarded = [];

    public function path(){
        return "/vacunas-personas/$this->id";

    }

    public function person(){
        return $this->belongsTo("App\Models\Person");

    }

    public function vaccination(){
        return $this->belongsTo("App\Models\Vaccination");
    }

}
