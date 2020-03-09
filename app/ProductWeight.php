<?php


namespace App;



use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    protected $table = 'product_weight';
    protected $fillable = [
        'weight', 'product_id','price'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}