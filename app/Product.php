<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const disable = 'false';
    const enable = 'true';
 protected $fillable = [
     'name',
     'description',
     'quantity',
     'status',
     'image',
     'seller_id'
 ];
    public function statusEnable() {
        return $this->status == Product::disable;
    }
}
