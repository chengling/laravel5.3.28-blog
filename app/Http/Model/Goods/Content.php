<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

	protected   $table='goods_content';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
