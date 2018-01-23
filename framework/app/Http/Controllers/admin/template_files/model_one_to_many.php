<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class ==big_table== extends Model
{
    protected @@@table = '==table==';
    protected @@@primaryKey = '==primary_key==';
    public @@@timestamps = false;
    public @@@allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll(@@@table){
      return DB::table(@@@table)->get();
    }


    public function get==big_table==(@@@id){
      @@@data =  ==big_table==::where('==primary_key==', @@@id)->get();
      if(count(@@@data)){
        return @@@data[0];
      } else{
        return array();
      }
    }

    public function get==big_table==View(@@@id){
      $==table== = ==big_table==::select(array('==table==.*'==select_alias==));
      $==table==->where('==table==.==primary_key==', $id);
      ==select_join==
      return @@@==table==->get()[0];

    }

    public function multiSelectInsert(@@@r_table, @@@field1, @@@value1, @@@field2, @@@value2=array())
    {
      DB::table("@@@r_table")->where("@@@field1", @@@value1)->delete();
      if (@@@r_table!="" && @@@field1!="" && @@@value1!="" && @@@field2!="" && count(@@@value2)>0) {
        for (@@@i=0; @@@i < count(@@@value2); @@@i++) {
          @@@data[] = array(
            @@@field1 => @@@value1,
            @@@field2 => @@@value2[@@@i],
          );
        }
        DB::table("@@@r_table")->insert(@@@data);
      }
    }

    public function getSelectedIds(@@@table, @@@id, @@@select_field, @@@where_field)
    {
       @@@arr = array();
       @@@data = DB::table("@@@table")->select("@@@select_field")->where(array(@@@where_field=>@@@id))->get();
       foreach (@@@data as @@@key => @@@value) {
            @@@arr[] = @@@value->@@@select_field;
        }
        return @@@arr;
    }


    function getSelectedData(@@@table, @@@field, @@@idArr) {
        @@@arr = array();
        @@@data = DB::table("@@@table")->select("*")->whereIn("==primary_key==",@@@idArr)->get();
        foreach (@@@data as @@@key => @@@value) {
            @@@arr[] = @@@value->@@@field;
        }
        return @@@arr;
    }


    public function changeStatus(@@@field, @@@id){
      @@@==table== = @@@this->get==big_table==(@@@id);
      if(count(@@@==table==)){
        ==change_status_fields==
            return true;
      } else{
        return false;
      }
    }

    public function deleteOne(@@@id){
      @@@==table== = @@@this->get==big_table==(@@@id);
      if(count(@@@==table==)){
        @@@img = public_path().'/uploads/'.@@@==table==->featured_img;
            if(@@@==table==->featured_img!='' && file_exists(@@@img)){
                unlink(@@@img);
            }
            @@@==table==->delete();
        return true;
      } else{
        return false;
      }
    }
    
    public function get==big_table==Data(@@@per_page, @@@searchBy, @@@searchValue, @@@sortBy, @@@order){
      @@@==table== = ==big_table==::select(array('==table==.*'==select_alias==));
      
      //join
        ==select_join==

        // where condition
        if(@@@searchBy!='' && @@@searchValue!=''){
          @@@==table==->where(@@@searchBy, 'like', '%'.@@@searchValue.'%');
        }

        // sort option
        if(@@@sortBy!='' && @@@order!=''){
          @@@==table==->orderBy(@@@sortBy, @@@order);
        } else{
          @@@==table==->orderBy('==table==.==primary_key==', 'desc');
        }        

        return @@@==table==->paginate(@@@per_page);
    }

    public function get==big_table==Export(@@@searchBy, @@@searchValue, @@@sortBy, @@@order){
      @@@==table== = ==big_table==::select(array('==table==.*'==select_alias==));

      //join
        ==select_join==

        // where condition
        if(@@@searchBy!='' && @@@searchValue!=''){
          @@@==table==->where(@@@searchBy, 'like', '%'.@@@searchValue.'%');
        }

        // sort option
        if(@@@sortBy!='' && @@@order!=''){
          @@@==table==->orderBy(@@@sortBy, @@@order);
        } else{
          @@@==table==->orderBy('==table==.==primary_key==', 'desc');
        }
        return @@@==table==->get();
    }

    public function update==big_table==(@@@request){
      @@@id = @@@request->input('==primary_key==');
      @@@==table== = ==big_table==::get==big_table==(@@@id);
      if(count(@@@==table==)){

          ==set_value_arr==

          @@@==table==->save();
          return true;
      } else{
        return false;
      }
    }

    public function add==big_table==(@@@request){
      @@@==table== = new ==big_table==;

        ==set_value_arr==

        @@@==table==->save();
        return true;
    }
}
