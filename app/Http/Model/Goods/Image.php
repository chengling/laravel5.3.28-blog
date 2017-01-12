<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	protected   $table='goods_images';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
