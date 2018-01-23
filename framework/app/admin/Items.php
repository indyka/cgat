<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->get();
    }


    public function getItems($id){
      $data =  Items::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getItemsView($id){
      $items = Items::select(array('items.*'));
      $items->where('items.id', $id);
      
      return $items->get()[0];

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

    public function getSelectedIds($table, $id, $select_field, $where_field)
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
      $items = $this->getItems($id);
      if(count($items)){
        
            return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $items = $this->getItems($id);
      if(count($items)){
        $img = public_path().'/uploads/'.$items->featured_img;
            if($items->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $items->delete();
        return true;
      } else{
        return false;
      }
    }
    
    public function getItemsData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $items = Items::select(array('items.*'));
      
      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $items->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $items->orderBy($sortBy, $order);
        } else{
          $items->orderBy('items.id', 'desc');
        }        

        return $items->paginate($per_page);
    }

    public function getItemsExport($searchBy, $searchValue, $sortBy, $order){
      $items = Items::select(array('items.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $items->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $items->orderBy($sortBy, $order);
        } else{
          $items->orderBy('items.id', 'desc');
        }
        return $items->get();
    }

    public function updateItems($request){
      $id = $request->input('id');
      $items = Items::getItems($id);
      if(count($items)){

          $items->description = $request->input('description')!="" ? $request->input('description') : "";
	$items->created_at = $request->input('created_at')!="" ? $request->input('created_at') : "";
	$items->updated_at = $request->input('updated_at')!="" ? $request->input('updated_at') : "";

          $items->save();
          return true;
      } else{
        return false;
      }
    }

    public function addItems($request){
      $items = new Items;

        $items->description = $request->input('description')!="" ? $request->input('description') : "";
	$items->created_at = $request->input('created_at')!="" ? $request->input('created_at') : "";
	$items->updated_at = $request->input('updated_at')!="" ? $request->input('updated_at') : "";

        $items->save();
        return true;
    }
}
