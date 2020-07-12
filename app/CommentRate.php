<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentRate extends Model
{
    protected $table = 'comment_rate';
    protected $fillable = [
    	'id_product', 'rate', 'id_user' , 'name_user', 'avatar', 'content',
    ];

    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }

    public function product(){
    	return $this->belongsTo('App\Product','id_product','id');
    }
}
