<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

	protected   $table='goods_brand';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
