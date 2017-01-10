<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{

	protected   $table='goods_spec';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
