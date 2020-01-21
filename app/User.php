<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const disable = 'false';
    const enable = 'true'; 

    const userAdmin = 'super';
    const userRegular = 'student';



    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verified',
        'verification_token',
        'role'
    ];

    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token'
    ]; 

    public function verified() {
        return $this->verified == User::enable;
    }

    public function roleAdmin() {
        return $this->role == User::userAdmin;
    }

    public function generateToken() {
        return str_random(40);
    } 
}
