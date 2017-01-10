<?php
/**
 * @desc 商品规格管理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Goods\Spec;
use App\Http\Model\Goods\Type;
use App\Http\Model\Goods\SpecItem;
use Illuminate\Support\Facades\Input;
class SpecController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Spec::orderBy('id','desc')->paginate(10);
    	$list = Type::all()->toArray();
		
    	$typeList = array();
    	foreach($list as $key => $value)
    	{
    		$typeList[$value['id']] = $value['name'];
    	}
    	foreach($data as $key => $value)
    	{
    		$value['type_name'] = $typeList[$value['type_id']];
    		$data[$key] = $value;
    	}
    	return view('admin.goods.Spec.index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	$list = Type::all();
    	return view('admin.goods.Spec.add',['list' => $list]);
    }
    
    /**
    * @desc创建属性
    * @access 
    * @param
    * @return
    */
    public function store()
    {	
    	 $data = Input::except('_method','_token','item');
    	 if($data['type_id'])
    	 {
    	 	return ['status' => 1,'msg' =>'请选择商品类型'];
    	 }
    	 $specModel = new Spec();
    	 foreach($data as $key => $value)
    	 {
    	 	$specModel->$key = $value;
    	 }
    	 $result = $specModel->save();
    	 $item = explode(PHP_EOL,$_POST['item']);
    	 foreach($item as $key => $value)
    	 {
	    	$specItemModel = new SpecItem();
    	 	$specItemModel->spec_id = $specModel->id;
    	 	$specItemModel->item = $value;
    	 	$specItemModel->save();
    	 }
    	 if($result)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加规格失败'];
    }
    
    
    
    public function edit($id)
    {	
    	
    	$result = Spec::find($id);
    	$list = Type::all();
   		$items = SpecItem::where('spec_id',$id)->get()->toArray();
    	$spectItems = '';
    	foreach ($items as $key => $value)
    	{
    		$spectItems[] = $value['item'];
    	}
    	$result['item'] = implode(PHP_EOL, $spectItems);
   		return view('admin.goods.spec.edit',['result' => $result,'id' => $id,'list' => $list]);
    }
    
    //
    public function update($id)
    {
    	 $data = Input::except('_method','_token','item');
    	 $postItems = Input::get('item');
    	 $postItems = explode(PHP_EOL,$postItems);

    	 $result = Spec::where('id',$id)->update($data);
    	 
    	 $specItems = SpecItem::where('spec_id',$id)->get()->toArray();
    	 $items = [];
    	 foreach($specItems as $value)
    	 {
    	 	$items[] = $value['item'];
    	 }
    	 foreach($postItems as $itemValue)
    	 {
    	 	if(!in_array($itemValue, $items))
    	 	{
    	 		$specItemModel = new SpecItem();
    	 		$specItemModel->spec_id = $id;
    	 		$specItemModel->item = $itemValue;
    	 		$specItemModel->save();
    	 	}
    	 }
    	 foreach($items as $value)
    	 {
    	 	if(!in_array($value, $postItems))
    	 	{
    	 		SpecItem::whereRaw('spec_id = ? and item=?',[$id,$value])->delete();
    	 	}	
    	 }
    	 
    	 if($result !== false)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改失败'];
    }
    
    //
    public function destroy($id)
    {
    	 Spec::where('id',$id)->delete();
    	 SpecItem::where('spec_id','=',$id)->delete();
    	 return ['status' => 0];
    }
}
