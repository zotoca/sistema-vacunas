<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    public function street(){
        return $this->belongsTo("App\Models\Street");
    }

    public function path(){
        return "/casas/$this->id";


    }

}
