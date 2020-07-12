<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    protected $table = 'reply_comments';
    protected $fillable = [
    	'id_product', 'id_comment', 'id_vendor' , 'name_shoper', 'avatar', 'content', 'content',
    ];

    public function product(){
    	return $this->belongsTo('App\Product','id_product','id');
    }
} 

