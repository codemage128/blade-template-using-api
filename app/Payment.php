<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'paylist';
    protected $fillable = [
        'product_id', 'amount', 'total_amount',
        'total_bitcoin', 'pay_status', 'custominfo', 'input_address', 'isdeleted','payed_bitcoin', 'customer_email'
    ];

    public function product(){
        return $this->belongsTo('App\Payment');
    }

    protected $guarded = ['id'];
}
