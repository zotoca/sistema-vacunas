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
    
    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    
    public function father(){
        return $this->belongsTo("App\Models\Person","father_id","id");
    }

    public function mother(){
        return $this->belongsTo("App\Models\Person","mother_id", "id");
    }

    public function sons(){
        return $this->hasMany("App\Models\Person",'father_id','id')->orWhere('mother_id', $this->id);
    }
    



}
