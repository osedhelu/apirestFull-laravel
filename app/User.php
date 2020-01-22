<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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

    public function verifiedFn() {
        return $this->verified == User::enable;
    }

    public function roleAdmin() {
        return $this->role == User::userAdmin;
    }

    public static function generateToken() {
        return str_random(40);
    } 
}
