<?php
namespace  App\Http\Lib;
class Category
{
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
				$arr['text']=$cate['name'];
				$arr['children']=$this->getTree($list,$cate['id'],$searchCateId);
				$arr['id']=$cate['id'];
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
				$value['name'] = str_repeat('———', $level).$value['name'];
				$tree[] = $value;
				$tree = array_merge($tree,$this->getLevel($list,$value['id'],$level+1));
			}
		}
		return $tree;
	}
}