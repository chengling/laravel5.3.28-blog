<?php

namespace App\Http\Model\User;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

	protected   $table='user_account';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
