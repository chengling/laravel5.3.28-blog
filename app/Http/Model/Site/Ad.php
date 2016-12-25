<?php

namespace App\Http\Model\Site;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{

	protected   $table='site_ad';
	
	protected  $primaryKey='ad_id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
