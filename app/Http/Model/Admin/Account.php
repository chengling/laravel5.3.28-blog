<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected   $table='desktop_account';
    
    protected  $primaryKey='account_id';
    
    public  $timestamps=false;
    
    protected $guarded = ['account_id', 'login_name'];
    
}
