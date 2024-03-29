<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeVaccinationDate($query, $vaccination_date){
    
        if($vaccination_date != ""){
            return $query->where("vaccination_date","LIKE","%$vaccination_date%");
        }
    }

    public function scopeVaccinationId($query, $vaccination_id){
       
        if($vaccination_id != ""){
            return $query->where("vaccination_id",$vaccination_id);
        }
    }
    public function scopePersonDni($query, $dni){
       
        if($dni != ""){
            return $query->whereHas("person",function (Builder $query) use ($dni){
                $query->where("dni","like","%$dni%");
            });
        }
    }

    public function scopeDose($query, $dose){
        if($dose !=""){
            return $query->where("dose", "LIKE", "%$dose%");
        }
    }
    public function scopeLotNumber($query, $lot_number){
        if($lot_number != ""){
            return $query->where("lot_number", "LIKE", "%$lot_number%");
        }
    }

    public function scopeIsVaccinated($query, $is_vaccinated){
        if($is_vaccinated != ""){
            
            return $query->where("is_vaccinated", $is_vaccinated);
        }
    }

}
