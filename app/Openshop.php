<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Openshop extends Model
{
    protected $table = 'openshop';
    protected $fillable = [
    	'id_user', 'name_shop', 'email_shop' , 'email_shop' , 'avatar_shop' , 'address_shop' , 'phone_shop' ,
    ];

    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }
}
