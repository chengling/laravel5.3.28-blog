<?php

namespace App\Http\Model\Site;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	protected   $table='site_link';
	
	protected  $primaryKey='link_id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
