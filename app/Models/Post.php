<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    public function path(){

        return "/foro/$this->id";

    }

    public function user(){
        return $this->belongsTo("App\Models\User");

    }

    public function scopeTitle($query, $title){
        if($title != ""){
            return $query->where("title", "LIKE", "%$title%");


        }


    }
}

