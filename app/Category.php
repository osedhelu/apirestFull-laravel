<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // $fillable son los atributos que se asigna de manera masiva cuando se realizan peticiones al servido de metos create, upadte
    protected $fillable = [
        'name',
        'description'
    ];



}
