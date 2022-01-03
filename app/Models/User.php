<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'first_name',
        "last_name",
        'email',
        "image_url",
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function path(){
        return "/administradores/$this->id";
    }

    public function scopeFirstName($query, $first_name){
        if($first_name != ""){
            
            return $query->where("first_name", "LIKE", "%$first_name%");
        }
    }
    
    public function scopeLastName($query, $last_name){
        if($last_name != ""){
            
            return $query->where("last_name", "LIKE", "%$last_name%");
        }
    }
}
