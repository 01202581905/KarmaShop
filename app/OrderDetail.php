<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
    	'id_order', 'id_product', 'id_vendor' , 'money', 'quantity', 'size', 'color',
    ];

    public function order(){
    	return $this->belongsTo('App\Order','id_order','id');
    }

    public function product(){
    	return $this->belongsTo('App\Product','id_product','id');
    }

}
