<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'producs';
    protected $fillable = [
    	'name', 'slug', 'id_vendor' , 'image', 'list_image', 'content', 'description', 'quantity', 'price', 'promotional', 'id_type', 'id_category', 'rate', 'size', 'color', 'status',
    ];

    public function productType(){
    	return $this->belongsTo('App\ProductType','id_type','id');
    }

    public function productCategory(){
    	return $this->belongsTo('App\ProductCategory','id_category','id');
    }

    public function vendor(){
        return $this->belongsTo('App\Shoper','id_vendor','id');
    }
}
