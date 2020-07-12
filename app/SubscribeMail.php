<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscribeMail extends Model
{
     protected $table = 'subscribe_mail';

    protected $fillable = [
    	'mail' ,
    ];
}
