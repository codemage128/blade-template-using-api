<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name', 'avatar','des_short', 'des_long',
        'price_fee_first','price_fee_second', 'price_fee_third', 'status'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public function payment(){
        return $this->hasMany("App\Payment");
    }
}
