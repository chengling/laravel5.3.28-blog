<?php

namespace App\Http\Model\Article;

use Illuminate\Database\Eloquent\Model;

class ArticleBody extends Model
{
	protected   $table='article_body';
	
	protected  $primaryKey='id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
}
