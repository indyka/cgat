<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    protected $table = 'demo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->get();
    }


    public function getDemo($id){
      $data =  Demo::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getDemoView($id){
      $demo = Demo::select(array('demo.*'));
      $demo->where('demo.id', $id);
      
      return $demo->get()[0];

    }

    public function multiSelectInsert($r_table, $field1, $value1, $field2, $value2=array())
    {
      DB::table("$r_table")->where("$field1", $value1)->delete();
      if ($r_table!="" && $field1!="" && $value1!="" && $field2!="" && count($value2)>0) {
        for ($i=0; $i < count($value2); $i++) {
          $data[] = array(
            $field1 => $value1,
            $field2 => $value2[$i],
          );
        }
        DB::table("$r_table")->insert($data);
      }
    }

    public function getSelectedIds($table, $id, $where_field, $select_field)
    {
       $arr = array();
       $data = DB::table("$table")->select("$select_field")->where(array($where_field=>$id))->get();
       foreach ($data as $key => $value) {
            $arr[] = $value->$select_field;
        }
        return $arr;
    }


    function getSelectedData($table, $field, $idArr) {
        $arr = array();
        $data = DB::table("$table")->select("*")->whereIn("id",$idArr)->get();
        foreach ($data as $key => $value) {
            $arr[] = $value->$field;
        }
        return $arr;
    }


    public function changeStatus($field, $id){
      $demo = $this->getDemo($id);
      if(count($demo)){
        
            return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $demo = $this->getDemo($id);
      if(count($demo)){
        $img = public_path().'/uploads/'.$demo->featured_img;
            if($demo->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $demo->delete();
        return true;
      } else{
        return false;
      }
    }
    
    public function getDemoData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $demo = Demo::select(array('demo.*'));
      
      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $demo->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $demo->orderBy($sortBy, $order);
        } else{
          $demo->orderBy('demo.id', 'desc');
        }        

        return $demo->paginate($per_page);
    }

    public function getDemoExport($searchBy='', $searchValue='', $sortBy='', $order=''){
      $demo = Demo::select(array('demo.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!='') {
          $demo->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        if (isset($rel_arr) && !empty($rel_arr)) {
            $products->where($rel_arr['rel_field'], '=', $rel_arr['rel_id']);
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $demo->orderBy($sortBy, $order);
        } else{
          $demo->orderBy('demo.id', 'desc');
        }
        return $demo->get();
    }

    public function updateDemo($request){
      $id = $request->input('id');
      $demo = Demo::getDemo($id);
      if(count($demo)){

          $demo->image = $request->input('image')!="" ? $request->input('image') : "";
	$demo->name = $request->input('name')!="" ? $request->input('name') : "";
	$demo->address = $request->input('address')!="" ? $request->input('address') : "";

          $demo->save();
          return true;
      } else{
        return false;
      }
    }

    public function addDemo($request){
      $demo = new Demo;

        $demo->image = $request->input('image')!="" ? $request->input('image') : "";
	$demo->name = $request->input('name')!="" ? $request->input('name') : "";
	$demo->address = $request->input('address')!="" ? $request->input('address') : "";

        $demo->save();
        return $demo->id;
    }
}
