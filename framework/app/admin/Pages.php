<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->get();
    }


    public function getPages($id){
      $data =  Pages::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPagesView($id){
      $pages = Pages::select(array('pages.*'));
      $pages->where('pages.id', $id);
      
      return $pages->get()[0];

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
      $pages = $this->getPages($id);
      if(count($pages)){
        
            return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $pages = $this->getPages($id);
      if(count($pages)){
        $img = public_path().'/uploads/'.$pages->featured_img;
            if($pages->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $pages->delete();
        return true;
      } else{
        return false;
      }
    }
    
    public function getPagesData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $pages = Pages::select(array('pages.*'));
      
      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $pages->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $pages->orderBy($sortBy, $order);
        } else{
          $pages->orderBy('pages.id', 'desc');
        }        

        return $pages->paginate($per_page);
    }

    public function getPagesExport($searchBy='', $searchValue='', $sortBy='', $order=''){
      $pages = Pages::select(array('pages.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!='') {
          $pages->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        if (isset($rel_arr) && !empty($rel_arr)) {
            $products->where($rel_arr['rel_field'], '=', $rel_arr['rel_id']);
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $pages->orderBy($sortBy, $order);
        } else{
          $pages->orderBy('pages.id', 'desc');
        }
        return $pages->get();
    }

    public function updatePages($request){
      $id = $request->input('id');
      $pages = Pages::getPages($id);
      if(count($pages)){

          $pages->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
	$pages->theme_id = $request->input('theme_id')!="" ? $request->input('theme_id') : "";

          $pages->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPages($request){
      $pages = new Pages;

        $pages->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
	$pages->theme_id = $request->input('theme_id')!="" ? $request->input('theme_id') : "";

        $pages->save();
        return $pages->id;
    }
}
