<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
    	'code_order', 'id_user', 'address' , 'name_recipient', 'email', 'phone', 'letter', 'total_money', 'total_quantity' , 'status', 'payment_method', 'fee',
    ];

    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }
}
