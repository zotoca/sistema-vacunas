<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = [
        "person_id",
        "person_dni",
        "action_type",
        "user_id"
    ];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }

    public function scopeUserFirstName($query, $first_name){
        if(isset($first_name)){
            return $query->whereHas("user", function ($query) use ($first_name){
                return $query->where("first_name", "LIKE", "%$first_name%");
            });
        }
    }

    public function scopeUserLastName($query, $last_name){
        if(isset($last_name)){
            return $query->whereHas("user", function ($query) use ($last_name){
                return $query->where("last_name", "LIKE", "%$last_name%");
            });
        }
    }
}
