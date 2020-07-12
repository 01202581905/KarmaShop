<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
    	'id_user', 'id_product', 'name', 'slug' , 'image', 'quantity', 'price', 'promotional' , 'size', 'color',
    ];

    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }

    public function product(){
    	return $this->belongsTo('App\Product','id_product','id');
    }
}
