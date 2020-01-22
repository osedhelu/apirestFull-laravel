<?php

namespace App;
use App\Seller;
use App\Category;
use App\Transaction;
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
    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    public function transactionFn() {
        return $this->hasMany(Transaction::class);
    }    

    public function categoryFn() {
        return $this->belongsToMany(Category::class);
    }
}
