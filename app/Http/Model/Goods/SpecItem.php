<?php

namespace App\Http\Model\Goods;

use Illuminate\Database\Eloquent\Model;

class SpecItem extends Model
{

	protected   $table='goods_spec_item';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
