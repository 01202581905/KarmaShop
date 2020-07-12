<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_type';

    protected $fillable = [
    	'id_category' ,'name' , 'slug',
    ];

    public function ProductCategory(){
    	return $this->belongsTo('App\ProductCategory','id_category','id');	
    }
}
