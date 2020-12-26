<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "image_url",
        "user_id",
    ];


    public function path(){

        return "/foro/$this->id";

    }

    public function user(){
        return $this->belongsTo("App\Models\User");

    }

    public function comments(){
        return $this->hasMany("App\Models\Comment");
    }

    public function scopeTitle($query, $title){
        if($title != ""){
            return $query->where("title", "LIKE", "%$title%");


        }


    }
}

