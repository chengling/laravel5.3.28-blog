<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{

	protected   $table='goods_attribute';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
