<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

	protected   $table='goods_type';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
