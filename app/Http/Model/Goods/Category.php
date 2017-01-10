<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected   $table='goods_category';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
