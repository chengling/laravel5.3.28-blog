<?php

namespace App\Http\Model\Article;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected   $table='article_cat';
	
	protected  $primaryKey='cat_id';
	
	public  $timestamps=false;
	
	protected $guarded=[];
	
	/**
	 * @desc得到树状结构的tree
	 * @access
	 * @param
	 * @return
	 */
	public function getTree($list,$parentId=0,$searchCateId=0)
	{
		$tree=array();
		foreach($list as  $cate)
		{
			if($cate['parent_id']==$parentId)
			{
				$arr['text']=$cate['cat_name'];
				$arr['children']=$this->getTree($list,$cate['cat_id'],$searchCateId);
				$arr['id']=$cate['cat_id'];
				$arr['state']=array('opened'=>true);
				$arr['icon']='none';
				if($searchCateId==$cate['id'])
				{
					$arr['a_attr']=array('style'=>'color:#1c84c6');
				}else
				{
					$arr['a_attr']=array('style'=>'color:#888888');
				}
				$tree[]=$arr;
			}
		}
		return $tree;
	}
	
	
	/**
	 * @desc 得到有层次的栏目
	 * @access
	 * @param
	 * @return
	 */
	public function getLevel($list,$parent_id=0,$level=0)
	{
		$tree = array();
		foreach($list as $key => $value)
		{
			if($value['parent_id'] == $parent_id)
			{
				$value['level'] = $level;
				$value['cat_name'] = str_repeat('———', $level).$value['cat_name'];
				$tree[] = $value;
				$tree = array_merge($tree,$this->getLevel($list,$value['cat_id'],$level+1));
			}
		}
		return $tree;
	}
}
