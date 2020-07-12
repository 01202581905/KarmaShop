<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerSlide extends Model
{
    protected $table = 'banner_slides';
    protected $fillable = [
    	'image', 'rate', 'status' ,
    ];
}
