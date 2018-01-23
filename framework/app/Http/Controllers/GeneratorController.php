<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use DB;

class GeneratorController extends Controller
{
	public function index()
	{
		return view('generator/add',array("Tables"=>$this->getAllTables()));
	}

    public function getPkByTable($table)
    {
        $result = DB::select("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
        return $result[0]->Column_name;
    }

	public function getAllTables(){
		$tbls = array();
        $database = DB::getDatabaseName();
		$tables = DB::select('SHOW TABLES');
		$tbl_name = "Tables_in_".$database;
		foreach($tables as $tbl)
		{
			$tbls[] = $tbl->$tbl_name;
		}
		return $tbls;
	}

	public function getAllFields($table){
		$fields = DB::select('show fields in '.$table);
		foreach($fields as $field)
		{
			$field_names[] = $field->Field;
		}
		return $field_names;
	}

	public function add(Request $request){

            $table = $_POST['table_name'];
            $pkId = $this->getPkByTable($table);
            $table_new = $_POST['table_name'];
            $cntlr = ucfirst($table);
            $base_path =  env('APP_PATH');

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Route Generator Start ////////////////////////
//////////////////////////////////////////////////////////////////////////


$file = $base_path . "/routes/web.php";
$data = file_get_contents($file);
$temp_strng = 'BO : ' . ucfirst($table);


if (strpos($data, $temp_strng) !== false) {
    $newRoute = '

    Route::post("/admin/pages/deleteAll", [ \'as\'=>\'admin.pages.deleteAll\',\'uses\'=>\'admin\PagesController@deleteAll\',\'middleware\' => [\'permission:item-delete\']]);
    Route::get("/admin/pages", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);
    Route::get("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@getAdd\',\'middleware\' => [\'permission:item-create\']]);
    Route::post("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@postAdd\',\'middleware\' => [\'permission:item-create\']]);
    Route::get("/admin/pages/edit/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getEdit\',\'middleware\' => [\'permission:item-edit\']]);
    Route::get("/admin/pages/status/{field}/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@status\',\'middleware\' => [\'permission:item-edit\']]);
    Route::get("/admin/pages/export/{type}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getExport\',\'middleware\' => [\'permission:item-list\']]);
    Route::post("/admin/pages/edit", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@postEdit\',\'middleware\' => [\'permission:item-edit\']]);
    Route::post("/admin/pages/delete", [ \'as\'=>\'admin.pages.delete\',\'uses\'=>\'admin\PagesController@delete\',\'middleware\' => [\'permission:item-delete\']]);
    Route::get("/admin/pages/view/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@view\',\'middleware\' => [\'permission:item-list\']]);

    ';
    // Exist already, so replace routes
    $rout_table = ucfirst($table);
    $newRoute = str_replace("pages", $table, $newRoute);
    $newRoute = str_replace("Pages", ucfirst($table), $newRoute);
    $start = '// BO : '.$rout_table;
    $end   = '// EO : '.$rout_table;
    $final_data = preg_replace('#('.$start.')(.*)('.$end.')#si', '$1 '.$newRoute.' $3', $data);
    file_put_contents($file, $final_data);
} else {
    $newRoute = '

    // BO : Pages
    Route::post("/admin/pages/deleteAll", [ \'as\'=>\'admin.pages.deleteAll\',\'uses\'=>\'admin\PagesController@deleteAll\',\'middleware\' => [\'permission:item-delete\']]);
    Route::get("/admin/pages", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);
    Route::get("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@getAdd\',\'middleware\' => [\'permission:item-create\']]);
    Route::post("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@postAdd\',\'middleware\' => [\'permission:item-create\']]);
    Route::get("/admin/pages/edit/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getEdit\',\'middleware\' => [\'permission:item-edit\']]);
    Route::get("/admin/pages/status/{field}/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@status\',\'middleware\' => [\'permission:item-edit\']]);
    Route::get("/admin/pages/export/{type}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getExport\',\'middleware\' => [\'permission:item-list\']]);
    Route::post("/admin/pages/edit", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@postEdit\',\'middleware\' => [\'permission:item-edit\']]);
    Route::post("/admin/pages/delete", [ \'as\'=>\'admin.pages.delete\',\'uses\'=>\'admin\PagesController@delete\',\'middleware\' => [\'permission:item-delete\']]);
    Route::get("/admin/pages/view/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@view\',\'middleware\' => [\'permission:item-list\']]);
    // EO : Pages

   // @@@@@#####@@@@@

    ';
    $rout_table = ucfirst($table);
    $newRoute = str_replace("pages", $table, $newRoute);
    $newRoute = str_replace("Pages", ucfirst($table), $newRoute);
    $final_data = str_replace("// @@@@@#####@@@@@", $newRoute, $data);
    file_put_contents($file, $final_data);
}
//////////////////////////////////////////////////////////////////////////
/////////////////////////// Route Generator Start ////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Menu Generator Start /////////////////////////
//////////////////////////////////////////////////////////////////////////
            $file = $base_path . "/resources/views/master.blade.php";
            $data = file_get_contents($file);
            $temp_strng = 'BO : ' . ucfirst($table);
            if (strpos($data, $temp_strng) !== false) {
                
            } else {
                $newMenu = '

				<!-- BO : Module -->
                <li <?php if($action == \'module\'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/module"><i class="fa fa-users"></i>
                    Module
                    </a>
                </li>
                <!--  EO : Module -->

               <!--  @@@@@#####@@@@@ -->

                ';
                $newMenu = str_replace("module", $table, $newMenu);
                $newMenu = str_replace("Module", ucfirst($table), $newMenu);
                $final_data = str_replace("<!--  @@@@@#####@@@@@ -->", $newMenu, $data);
                file_put_contents($file, $final_data);
            }
//////////////////////////////////////////////////////////////////////////
/////////////////////////// Menu Generator End ///////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Controller Generator Start ///////////////////
//////////////////////////////////////////////////////////////////////////
            $controller_path = $base_path . "/app/Http/Controllers/admin/";
            $file = $controller_path . ucfirst($table) . 'Controller.php';
            $handle = fopen($file, 'w') or die('Cannot open file:  ' . $file);
            $current = "";
            $myfile = fopen($base_path . "/app/Http/Controllers/admin/template_files/controller.php", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/controller.php"));
            fclose($myfile);
            // Write the contents back to the file
            file_put_contents($file, $current);

            $data = file_get_contents($file);
            // do tag replacements or whatever you want
            $data = str_replace("=*=", "$", $data);
            $data = str_replace("=@=", "->", $data);

///////////////////////////////////////////////////////////
//////////////////// Generate Validation Start ////////////
///////////////////////////////////////////////////////////
            $alias = "";
            $select_join = "";
            $validations = array();
            $fields = "";
            $foreign_tables = '';
            $sort_fields_arr = array();
            $status_field = 'status';
            $valds = "";
            $status_field_string="";
            $status_arr = array();
            $set_value_arr = array();
            $change_status_fields="";
            $foreign_view_parameters = array();

            foreach ($_POST['ischeck'] as $key => $value) {

                if ($_POST[$value][0] == "image") {
                    $set_value_arr[] = '$'.$table.'->'.$value.' = $request->input(\''.$value.'\')=="" ? $request->input(\'old_'.$value.'\') : $request->input(\''.$value.'\') ;';
                }
                else
                {
                    $set_value_arr[] = '$'.$table.'->'.$value.' = $request->input(\''.$value.'\')!="" ? $request->input(\''.$value.'\') : "";';   
                }


                if(isset($_POST['required_'.$value]))
                {
                   $rules = implode("|", $_POST['required_'.$value]);
                   $validations[] = " '$value'=> '$rules' ";
                }
               $val_string = implode(", \n\t", $validations);


                $vals_str = "";

if (isset($_POST['one_to_many']) && !empty($_POST['one_to_many'])) {
    $all_one_to_many_relations = json_decode($_POST['one_to_many']);

    foreach ($all_one_to_many_relations as $key => $value_rel) {
        $one_to_many_table = $value_rel->rel_table;
        $one_to_many_field = $value_rel->rel_field;
        if (isset($one_to_many_table) && !empty($one_to_many_table)) {

            // $alias .= " , DB::raw('count(".$one_to_many_table.".".$one_to_many_field.") as ".$one_to_many_table."_total') ";
            // $select_join .= ' $'.$table.'->leftJoin("' .$one_to_many_table. '", "' . $table . '.' . $pkId . '", "'."=".'", "'  . $one_to_many_table . '.' .$one_to_many_field. '"); 
            //                   $'.$table.'->groupBy("' . $table . '.' . $pkId . '");
            //                 ';
        }
    }    
}




                if ($_POST[$value][0] != 'select') {
                    $sort_fields_arr[] = "'" .$table.".". $value . "'";
                    $sort_fields_arr2[] = "'" . $value . "'";
                }

                if ($_POST[$value][0] == 'select') {
                    $foreign_tables .= '$data["' . $_POST[$value]["selected_table"] . '"]=$this->' . $table . '->getListTable("' . $_POST[$value]["selected_table"] . '");';

$foreign_view_parameters[] = '\''.$_POST[$value]["selected_table"].'\'=>$'.$table.'->getAll(\''.$_POST[$value]["selected_table"].'\')';

                    $alias .= " , '" . $_POST[$value]["selected_table"] . "." . $_POST[$value]["value"] . "'";

$select_join .= '$'.$table.'->leftJoin(\''.$_POST[$value]["selected_table"].'\', \''.$table . "." . $value.'\', \'=\',\''.$_POST[$value]["selected_table"] . "." . $_POST[$value]["key"].'\');';

                    $sort_fields_arr[] = "'" . $_POST[$value]["selected_table"] . "." . $_POST[$value]["value"] . "'";
                    $sort_fields_arr2[] = "'" . $value . "'";
                }

                $cap_field = ucfirst($value);
                if ($_POST[$value][0] == "status") {

                    $change_status_fields .='
                    if($field=="'.$value.'"){
                        $status = $'.$table.'->'.$value.';
                        if($status==1){
                            $status=0;
                        } else{
                            $status=1;
                        }
                        $'.$table.'->'.$value.'=$status;
                        $'.$table.'->save();
                    }
                    ';

                    $fields .= "\t\t@@@saveData['$value'] = set_value('$value');\n";
                    $status_field = $value;
                    $status_arr[] = "'$value'";
                } 
                elseif ($_POST[$value][0] == "image") 
                {

                    $set_value_arr[] = '
                    // image upload code
                    $'.$value.'_name=\'\';
                    $'.$value.'_file = $request->file(\''.$value.'\');
                    if(!is_null($'.$value.'_file) && in_array($'.$value.'_file->getClientOriginalExtension(), $this->allow_image)){
                        $'.$value.'_name = time().\'_\'.$'.$value.'_file->getClientOriginalName();
                        $'.$value.'_file->move(\'uploads\',$'.$value.'_name);
                        $'.$table.'->'.$value.' = $'.$value.'_name;
                    }
                    ';
                } 
                elseif ($_POST[$value][0] == "checkbox") 
                {
                    $set_value_arr[] = '
                    if($request->input("'.$value.'")!=null)
                    {
                      $'.$table.'->'.$value.' = implode(",",$request->input("'.$value.'"));
                    } 
                    else
                    {
                         $'.$table.'->'.$value.'="";
                    }

                    ';
                }
                elseif ($_POST[$value][0] == "radio") 
                {
                   $fields .= "\t\t@@@saveData['$value'] = '$value';\n";
                }
                elseif($_POST[$value][0] == "radio")
                {
                   $fields .= "\t\t@@@saveData['$value'] = set_value('$value');\n";
                }
            }




    $return_multi_selected_id = "";
    $call_multi_add = "";
    $call_multi_edit = "";
    $list_tbl = "";
    $multi_selected_id = "";
    $return_multi_selected_data = "";
    if (isset($_POST["multiselect"])) {
        for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {
            if ($_POST["multiselect"]["table"][$i]) {
                $rtable = $_POST["multiselect"]["r_table"][$i];
                $field1 = $_POST["multiselect"]["r_main"][$i];
                $field2 = $_POST["multiselect"]["r_multi"][$i];

                $call_multi_add .= "\n
                if (isset(@@@_POST['".$_POST["multiselect"]["table"][$i]."']) && count(@@@_POST['".$_POST["multiselect"]["table"][$i]."'])>0) {
                \n\t\t\t@@@==table==->multiSelectInsert(\"$rtable\", \"$field1\", @@@insert_id, \"$field2\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n}\n";

                $call_multi_edit .= "\n
                if (isset(@@@_POST['".$_POST["multiselect"]["table"][$i]."']) && count(@@@_POST['".$_POST["multiselect"]["table"][$i]."'])>0) {\n\t\t\t@@@==table==->multiSelectInsert(\"$rtable\", \"$field1\", @@@_POST['==primary_key=='], \"$field2\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n}\n";

                $list_tbl .= "\t@@@data['".$_POST["multiselect"]["table"][$i]."']=@@@==table==->getAll('".$_POST["multiselect"]["table"][$i]."');\n";

                $return_multi_selected_id.= "\n\t\t\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."'] = @@@==table==->getSelectedIds(\"$rtable\", @@@id, \"$field1\", \"$field2\");\n";

                $multi_selected_id.= "\n\t\t\t@@@selected_".$_POST["multiselect"]["table"][$i]."_id = @@@==table==->getSelectedIds(\"$rtable\", @@@id, \"$field1\", \"$field2\");\n";

                $return_multi_selected_data.= "\n\t\t\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."_data'] = array();
            if (isset(@@@selected_".$_POST["multiselect"]["table"][$i]."_id) && !empty(@@@selected_".$_POST["multiselect"]["table"][$i]."_id)) {
        \n\t\t\t\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."_data'] = @@@==table==->getSelectedData('".$_POST["multiselect"]["table"][$i]."', '".$_POST["multiselect"]["value"][$i]."', @@@selected_".$_POST["multiselect"]["table"][$i]."_id);\n\t\t}\n";
            }
        }
    }
///////////////////////////////////////////////////////////
//////////////////// Generate Validation End //////////////
///////////////////////////////////////////////////////////

    $sort_fields_arr = implode(', ', $sort_fields_arr);
    $sort_fields_arr2 = implode(', ', $sort_fields_arr2);
    $data = str_replace('***foreign_table***', $foreign_tables, $data);
    $data = str_replace('==foreign_view_parameters==', implode(",",$foreign_view_parameters), $data);

    if (count($foreign_view_parameters)>0) {
        $data = str_replace('==foreign_comma_view_parameters==', implode(",",$foreign_view_parameters), $data);
    }
    else {
        $data = str_replace('==foreign_comma_view_parameters==', "", $data);
    }

    $data = str_replace("==validation==", $val_string, $data);

    $data = str_replace("==call_multi_add==", $call_multi_add, $data);
    $data = str_replace("==call_multi_edit==", $call_multi_edit, $data);
    $data = str_replace("==return_multi_selected_id==", $return_multi_selected_id, $data);
    $data = str_replace("==multi_selected_id==", $multi_selected_id, $data);
    $data = str_replace("==return_multi_selected_data==", $return_multi_selected_data, $data);

    $data = str_replace("==fields==", $fields, $data);
    $data = str_replace("{{status_field}}", $status_field, $data);
    $data = str_replace("++sort_fields_arr++", $sort_fields_arr, $data);
    $data = str_replace("++sort_fields_arr2++", $sort_fields_arr2, $data);

    $data = str_replace("==list_tbl==", $list_tbl, $data);
    $data = str_replace("==table==", $table, $data);
    $data = str_replace("controller_name", ucfirst($table), $data);
    $data = str_replace("==primary_key==", $pkId, $data);
    $data = str_replace("@@@", "$", $data);

    $status_field_string = implode(", ", $status_arr);
    $data = str_replace("==status_field_string==", $status_field_string, $data);
    file_put_contents($file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Controller Generator End /////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Model Generator Start ////////////////////////
//////////////////////////////////////////////////////////////////////////

            $model_path = $base_path. "/app/admin/";
            $file = $model_path . ucfirst($table) . '.php';
            $handle = fopen($file, 'w') or die('Cannot open file:  ' . $file);

            $current = "";
            $exist_model_path = $base_path . "/app/Http/Controllers/admin/template_files/model.php";
            $myfile = fopen($exist_model_path, "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($exist_model_path));
            fclose($myfile);

			// Write the contents back to the file
            file_put_contents($file, $current);


    $data = file_get_contents($file);
    $current = str_replace("@@@", "$", $data);
    $current = str_replace("++sort_fields_arr++", $sort_fields_arr, $current);
    $current = str_replace("==table==", $table, $current);
    $current = str_replace("==big_table==", ucfirst($table), $current);
    $current = str_replace("==select_alias==", $alias, $current);
    $current = str_replace("==select_join==", $select_join, $current);
    $current = str_replace("==change_status_fields==", $change_status_fields, $current);
    $current = str_replace("==set_value_arr==", implode("\n\t", $set_value_arr), $current);
    $current = str_replace("==primary_key==", $pkId, $current);

    file_put_contents($file, $current);
//////////////////////////////////////////////////////////////////////////
/////////////////////////// Model Generator End //////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Add Generator Start /////////////////////
//////////////////////////////////////////////////////////////////////////

            $ori_path = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $add_file = $view_path . 'add.blade.php';
            $edit_file = $view_path . 'edit.blade.php';
            $manage_file = $view_path . 'index.blade.php';
            if (file_exists($add_file)) {
                $handle = fopen($add_file, 'w') or die('Cannot open file:  ' . $add_file);
            } else {
            	if (!file_exists($ori_path . $table)) {
            		mkdir($ori_path . $table, 0700);
            	}
                $handle = fopen($add_file, 'w') or die('Cannot open file:  ' . $add_file);
            }

            $current = "";
            $myfile = fopen($controller_path . "template_files/add.php", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/add.php"));
            fclose($myfile);

            file_put_contents($add_file, $current);
            $data = file_get_contents($add_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $formfields = "";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

////////////////////////////////////////////////////
/////////// GENERATE INPUT FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    if ($_POST[$value][0] == "input") {
                        echo "input field for $value";
                        $formfields .= '


	<!-- ' . ucfirst($value) . ' Start -->
	<div class="form-group">
	  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control" id="' . $value . '" name="' . $value . '" 
	    value="{{ old(\''.$value.'\') }}">
	  </div>
	  <div class="col-sm-5">
      <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
	</div> 
	<!-- ' . ucfirst($value) . ' End -->


	';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE INPUT FIELD FOR ADD /. /////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE DATE FIELD FOR ADD /. //////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "date") {
                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
	<div class="form-group">
	  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control span2 date" id="' . $value . '" name="' . $value . '" value="{{ old(\''.$value.'\') }}">
	  </div>
	  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
	</div> 
	<!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE DATE FIELD FOR ADD /. /////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "time") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="' . $value . '" class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control timepicker" id="' . $value . '" name="' . $value . '" value="{{ old(\''.$value.'\') }}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
	<!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "datetime") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="'.$value.'" class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control datetime" id="'.$value.'" name="'.$value.'" value="{{ old(\''.$value.'\') }}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
	<!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE TEXTAREA FIELD FOR ADD //////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "textarea") {
                        $formfields .= '

				<!-- ' . ucfirst($value) . ' Start -->
			<div class="form-group">
			  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
			  <div class="col-sm-4">
			    <textarea class="form-control" id="' . $value . '" name="' . $value . '">{{ old(\''.$value.'\') }}</textarea>
			  </div>
			  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
			</div> 
			<!-- ' . ucfirst($value) . ' End -->

			';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE TEXTAREA FIELD FOR ADD /. ///////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
////////// GENERATE SELECT FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "select") {

                        $formfields .= '
	<!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="'.$value.'" class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
          <select id="'.$value.'" name="'.$value.'" class="form-control select2">
            <?php
              foreach ($'.$_POST[$value]['selected_table'].' as $value) {
                echo \'<option value="\'.$value->' . $_POST[$value]['key'] . '.\'"> \'.$value->' . $_POST[$value]['value'] . '.\'</option>\';
              }
            ?>
          </select>
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
///////// ./ GENERATE SELECT FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
////////// GENERATE STATUS FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "status") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
	<div class="form-group">
        <label class="control-label col-md-3">' . ucwords(str_replace('_',' ',$value)) . '</label>
         <div class=" col-md-4 switch">
                    <div class="onoffswitch">
     <input type="checkbox" class="onoffswitch-checkbox" checked data-on-label="Yes" data-off-label="No"  name="' . $value . '" value="1" id="' . $value . '" <?php echo 1; ?> style="width:20px; height:20px;"/>
    {{ $errors->first("'.$value.'") }}
                        <label class="onoffswitch-label" for="' . $value . '">
                            <span class="onoffswitch-switch"></span>
                            <span class="onoffswitch-inner"></span>
                        </label>
                    </div>
                </div>

      </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
///////// ./ GENERATE STATUS FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE RADIO FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "radio") {
                        $formfields .= '

 <!-- ' . ucfirst($value) . ' Start -->
 <div class="form-group">
          <label class="col-sm-3 control-label">Select ' . ucwords(str_replace('_',' ',$value)) . '</label>
          <div class="col-sm-4">';
                        $rad_arr = $_POST[$value]['radios'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
            <span style="margin-right:20px;"><input type="radio" style="width:20px; height:20px;" name="' . $value . '" value="' . $rad_arr[$aaa] . '"   @if(old(\'' . $value . '\')==\'' . $rad_arr[$aaa] . '\') checked @endif > ' . $rad_arr[$aaa] . ' </span>';
                        }
                        $formfields .= '
        </div>
        <div class="col-sm-5">
        <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
/////// ./ GENERATE RADIO FIELD FOR ADD /. /////////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE CHECKBOX FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "checkbox") {
                        $formfields .= '

 <!-- ' . ucfirst($value) . ' Start -->
 <div class="form-group">
          <label class="col-sm-3 control-label">Select ' . ucwords(str_replace('_',' ',$value)) . '</label>
          <div class="col-sm-4">';
                        $rad_arr = $_POST[$value]['checks'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
            <span style="margin-right:20px;"><input type="checkbox"  @if(null !==old(\''.$value.'\') && in_array(\'' . $rad_arr[$aaa] . '\',old(\''.$value.'\'))) checked @endif style="width:20px; height:20px;" name="' . $value . '[]" value="' . $rad_arr[$aaa] . '"> ' . $rad_arr[$aaa] . ' </span>';
                        }
                        $formfields .= '
        </div>
        <div class="col-sm-5">
        <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
/////////// GENERATE CHECKBOX FIELD FOR ADD ////////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////////// GENERATE IMAGE FIELD FOR ADD /////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "image") {
                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
      <label for="address" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
      <div class="col-sm-6">
      <input type="file" name="' . $value . '" />
      <input type="hidden" name="old_' . $value . '" value="<?php if (isset($' . $value . ') && $' . $value . '!=""){echo $' . $value . '; } ?>" />
        <?php if(isset($' . $value . '_err) && !empty($' . $value . '_err)) 
        { foreach($' . $value . '_err as $key => $error)
        { echo "<div class=\"error-msg\"></div>"; } }?>
      </div>
        <div class="col-sm-3" >
      </div>
      <div class="col-sm-5">
        <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';

                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE IMAGE FIELD FOR ADD /. /////
////////////////////////////////////////////////////
                }

            }





if (isset($_POST["multiselect"])) {
    for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {
    
////////////////////////////////////////////////////
////////// GENERATE MULTI SELECT FIELD FOR ADD ///////////
////////////////////////////////////////////////////
    if ($_POST["multiselect"]["table"][$i]) {
    $value = $_POST["multiselect"]["table"][$i];
    $formfields .= '

      <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
              <select class="form-control select2" name="' . $value . '[]" id="' . $value . '" multiple="multiple">
              <option value="">Select ' . ucfirst($value) . '</option>
      <?php 
      if(isset($' . $value . ') && !empty($' . $value . ')):
      foreach($' . $value . ' as $key => $value): ?>
          <option value="<?php echo $value->' . $_POST["multiselect"]['key'][$i] . '; ?>">
            <?php echo $value->' . $_POST["multiselect"]['value'][$i] . '; ?>
          </option>
      <?php endforeach; ?>
      <?php endif; ?>
      </select>
        </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
}
////////////////////////////////////////////////////
///////// ./ GENERATE MULTI SELECT FIELD FOR ADD /. //////
////////////////////////////////////////////////////

    }
}



            $data = str_replace("==formfields==", $formfields, $data);
            $data = str_replace("singlequote", "'", $data);
            $data = str_replace("==table==", $table, $data);
            $data = str_replace("==big_table==", ucfirst($table), $data);
            file_put_contents($add_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Add Generator End ///////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Edit Generator Start ////////////////////
//////////////////////////////////////////////////////////////////////////
            $ori_path  = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $edit_file = $view_path . 'edit.blade.php';
            if (file_exists($edit_file)) {
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            } else {
                if (!file_exists($ori_path . $table)) {
            		mkdir($ori_path . $table, 0700);
            	}
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            }

            $current = "";
            $current = file_get_contents($controller_path . "template_files/edit.php");
         
            file_put_contents($edit_file, $current);
            $data = file_get_contents($edit_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $formfields = "";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

////////////////////////////////////////////////////
/////////// GENERATE Edit Input FIELD FOR ADD //////
////////////////////////////////////////////////////
                    if ($_POST[$value][0] == "input") {

                        $formfields .= '

<!-- ' . ucfirst($value) . ' Start -->
<div class="form-group">
  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="' . $value . '" name="' . $value . '" 
    
    value="{{{ $data->' . $value . ' }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
</div> 
<!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
/////// ./ GENERATE Edit Input FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Textarea FIELD FOR ADD ///
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "textarea") {
                        $formfields .= '
<!-- ' . ucfirst($value) . ' Start -->

<div class="form-group">
  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
  <div class="col-sm-4">
    <textarea class="form-control" id="' . $value . '" name="' . $value . '">{{{ $data->' . $value . ' }}}</textarea>
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
</div> 

<!-- ' . ucfirst($value) . ' End -->
';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Textarea FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Date FIELD FOR ADD ///////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "date") {
                        echo "input field for $value";
                        $formfields .= '

<!-- ' . ucfirst($value) . ' Start -->
<div class="form-group">
  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
  <div class="col-sm-4">
    <input type="text" class="form-control span2 date" id="' . $value . '" name="' . $value . '" value="{{{ $data->' . $value . ' }}}">
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
</div> 
<!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
//////// ./ GENERATE Edit Date FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "time") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="' . $value . '" class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control timepicker" id="' . $value . '" name="' . $value . '" value="{{{ $data->' . $value . ' }}}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
	<!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "datetime") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="' . $value . '" class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control datetime" id="' . $value . '" name="' . $value . '" value="{{{ $data->' . $value . ' }}}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
	<!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Select FIELD FOR ADD /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "select") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="user_id" class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
          <select id="'.$value.'" name="'.$value.'" class="form-control select2">
            <?php
              foreach ($' . $_POST[$value]['selected_table'] . ' as $value) {
                $selected = $data->'.$value.'==$value->' . $_POST[$value]['key'] . '?\'selected="selected"\':\'\';
                echo \'<option \'.$selected.\' value="\'.$value->' . $_POST[$value]['key'] . '.\'"> \'.$value->' . $_POST[$value]['value'] . '.\'</option>\';
              }
            ?>
          </select>
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Select FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Status FIELD FOR ADD /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "status") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
	 <div class="form-group">
        <label class="control-label col-md-3">' . ucwords(str_replace('_',' ',$value)) . '
             
        </label>                    
         <div class=" col-md-4 switch">
                    <div class="onoffswitch">
     <input type="checkbox" class="onoffswitch-checkbox"  data-on-label="Yes" data-off-label="No"  name="' . $value . '" value="1" id="' . $value . '" <?php if($data->' . $value . ' == 1){echo "checked=checked";}?> style="width:20px; height:20px;"/>
                    </div>
                </div>
      </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Status FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Radio FIELD FOR ADD //////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "radio") {

                        $formfields .= '

	<!-- ' . ucfirst($value) . ' Start -->
	<div class="form-group">
        <label class="col-sm-3 control-label">Select ' . ucwords(str_replace('_',' ',$value)) . '</label>
        <div class="col-sm-4">';
                    $rad_arr = $_POST[$value]['radios'];
                    for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                        $formfields .= '
            <span style="margin-right:20px;"><input type="radio" style="width:20px; height:20px;" <?php echo $data->' . $value . '=="' . $rad_arr[$aaa] . '"?\'checked="checked"\':""; ?> name="' . $value . '" value="' . $rad_arr[$aaa] . '"> ' . $rad_arr[$aaa] . ' </span>';
                    }
                    $formfields .= '
        </div>
	</div>
	<!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Status FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE Edit Checkbox FIELD FOR ADD /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "checkbox") {

                        $formfields .= '

		<!-- ' . ucfirst($value) . ' Start -->
		<div class="form-group">
		<label class="col-sm-3 control-label">Select ' . ucwords(str_replace('_',' ',$value)) . '</label>
		<div class="col-sm-4">
		<?php $arr=explode(",", $data->' . $value . ') ?>
		';
                        $rad_arr = $_POST[$value]['checks'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
			<span style="margin-right:20px;"><input type="checkbox" style="width:20px; height:20px;" <?php echo in_array("' . $rad_arr[$aaa] . '", $arr)?\'checked="checked"\':""; ?> name="' . $value . '[]" value="' . $rad_arr[$aaa] . '"> ' . $rad_arr[$aaa] . ' </span>';
                        }

                        $formfields .= '
	</div>
	</div>
	<!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Checkbox FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE Edit Image FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "image") {

    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
      <label for="'.$value.'" class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
        <div class="col-md-4">
          <input type="file" id="'.$value.'" name="'.$value.'" /><br>
          <?php if($data->'.$value.'!=\'\'){
            echo \'<img src="\'.url(\'/\')."/uploads/{$data->'.$value.'}".\'" style="width:100px;">\'; 
            } ?>
            <input type="hidden" name="old_'.$value.'" value="<?php echo $data->'.$value.'; ?>">
      </div>
      <div class="col-sm-5">
          <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
///// ./ GENERATE Edit Image FIELD FOR ADD /. //////
////////////////////////////////////////////////////
                }
            }



if (isset($_POST["multiselect"])) {
    for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {

////////////////////////////////////////////////////
////////// GENERATE MULTI SELECT FIELD FOR EDIT /////
////////////////////////////////////////////////////
    if ($_POST["multiselect"]["table"][$i]) {
    $value = $_POST["multiselect"]["table"][$i];
    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
          <div class="col-md-4">
              <select class="form-control select2" name="' . $value . '[]" id="' . $value . '" multiple="multiple">
              <option value="">Select ' . ucfirst($value) . '</option>
      <?php 
      if(isset($' . $value . ') && !empty($' . $value . ')):
      foreach($' . $value . ' as $key => $value): ?>
          <option <?php if(in_array($value->' . $_POST["multiselect"]['key'][$i] . ', $selected_'.$_POST["multiselect"]["table"][$i].')){ echo "selected"; } ?> value="<?php echo $value->' . $_POST["multiselect"]['key'][$i] . '; ?>">
            <?php echo $value->' . $_POST["multiselect"]['value'][$i] . '; ?>
          </option>
      <?php endforeach; ?>
      <?php endif; ?>
      </select>
        </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
}
////////////////////////////////////////////////////
////// ./ GENERATE MULTI SELECT FIELD FOR EDIT /. ///
////////////////////////////////////////////////////

    }
}


            $data = str_replace("==formfields==", $formfields, $data);
            $data = str_replace("==table==", $table, $data);
            $data = str_replace("==big_table==", ucfirst($table), $data);
            $data = str_replace("==primary_key==", $pkId, $data);
            $data = str_replace("singlequote", "'", $data);
            file_put_contents($edit_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Edit Generator End //////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Generator Start /////////////////////////
//////////////////////////////////////////////////////////////////////////

            $ori_path = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $edit_file = $view_path . 'view.blade.php';
            if (file_exists($edit_file)) {
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            } else {
                if (!file_exists($ori_path . $table)) {
            		mkdir($ori_path . $table, 0700);
            	}
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            }

            $current = "";
            $myfile = fopen($controller_path . "template_files/view.php.tpl", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/add_one_to_many.php"));
            fclose($myfile);

            file_put_contents($edit_file, $current);
            $data = file_get_contents($edit_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $formfields = "
<table class='table table-bordered' style='width:70%;' align='center'>";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

////////////////////////////////////////////////////
///////// GENERATE Edit Input FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    if ($_POST[$value][0] == "input") {

                        $formfields .= '
	<tr>
	 <td>
	   <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
	 </td>
	 <td> 
	   {{{ $data->' . $value . ' }}}
	 </td>
	</tr>
	';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Input FIELD FOR ADD /. /////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE Edit Date FIELD FOR ADD /////////
////////////////////////////////////////////////////
elseif ($_POST[$value][0] == "date" || $_POST[$value][0] == "time" || $_POST[$value][0] == "datetime") {
    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
	<tr>
	 <td>
	  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
	 </td>
	 <td> 
	   {{{ $data->' . $value . ' }}}
	 </td>
	</tr>
    <!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Date FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////// GENERATE Edit Textarea FIELD FOR ADD ///////
////////////////////////////////////////////////////
elseif ($_POST[$value][0] == "textarea") {
                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
	<tr>
	 <td>
	  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
	 </td>
	 <td> 
	   {{{ $data->' . $value . ' }}}
	 </td>
	</tr>
    <!-- ' . ucfirst($value) . ' End -->

	';

                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Textarea FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Select FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "select") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
	<tr>
	 <td>
	  <label class="control-label col-md-3"> ' . ucwords(str_replace('_',' ',$value)) . ' </label>
	 </td>
	 <td>
     {{{ $data->'.$_POST[$value]["value"].' }}}
	 </td>
	</tr>
    <!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Select FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Status FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "status") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
	<tr>
	 <td>
	  <label class="control-label col-md-3">' . ucwords(str_replace('_',' ',$value)) . '</label>
	 </td>
	 <td> 
	   <?php if($data->' . $value . ' == 1){echo "Active";}else{ echo "Inactive";}?>
	 </td>
	</tr>
    <!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Status FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Radio FIELD FOR ADD /////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "radio") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
	<tr>
	 <td>
	  <label class="col-sm-3 control-label">Select ' . ucfirst($value) . '</label>
	 </td>
	 <td> 
	   ';
                        $rad_arr = $_POST[$value]['radios'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
	   <?php echo $data->' . $value . '=="' . $rad_arr[$aaa] . '"?\'' . $rad_arr[$aaa] . '\':""; ?>';
                        }
                        $formfields .= '
	 </td>
	</tr>
    <!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Radio FIELD FOR ADD /. ///////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
////// GENERATE Edit Checkbox FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "checkbox") {
                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
	<tr>
	 <td>
	  <label class="col-sm-3 control-label">' . ucfirst($value) . '</label>
	 </td>
	 <td> 
	   {{{ $data->' . $value . ' }}}
	 </td>
	</tr>
    <!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Checkbox FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Image FIELD FOR ADD /////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "image") {
    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
	<tr>
	 <td>
	  <label for="address" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
	 </td>
     <td>
      <?php if($data->'.$value.'!=\'\')  echo \'<img src="\'.url(\'/\').\'/uploads/\'.$data->'.$value.'.\'" style="width:100px">\'; ?></td>
	 </td>
	</tr>
    <!-- ' . ucfirst($value) . ' End -->

	';
                    }
////////////////////////////////////////////////////
///// ./ GENERATE Edit Image FIELD FOR ADD /. //////
////////////////////////////////////////////////////
                }
            }



            if (isset($_POST["multiselect"])) {
        for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {
            if ($_POST["multiselect"]["table"][$i]) {
                $rtable = $_POST["multiselect"]["r_table"][$i];
                $field1 = $_POST["multiselect"]["r_main"][$i];
                $field2 = $_POST["multiselect"]["r_multi"][$i];
                $call_multi_add .= "\n\t@@@this->==table==->multiSelectInsert(\"$rtable\", \"$field2\", @@@insert_id, \"$field1\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n";
                $call_multi_edit .= "\n\t@@@this->==table==->multiSelectInsert(\"$rtable\", \"$field2\", @@@id, \"$field1\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n";
                $list_tbl .= "\n\t@@@data['".$_POST["multiselect"]["table"][$i]."']=@@@this->==table==->getList('".$_POST["multiselect"]["table"][$i]."');\n";
                $return_multi_selected_id.= "\n\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."'] = @@@==table==->getSelectedIds(\"$rtable\", @@@id, \"$field1\", \"$field2\");\n";

                $formfields .= '

                <!-- ' . ucfirst($_POST["multiselect"]["table"][$i]) . ' Start -->
                <tr>
                 <td>
                  <label for="address" class="col-sm-3 control-label"> ' . ucfirst($rtable) . ' </label>
                 </td>
                 <td>
                 <?php echo implode(", ", $selected_'.$_POST["multiselect"]["table"][$i].'_data); ?>
                 </td>
                </tr>
                <!-- ' . ucfirst($_POST["multiselect"]["table"][$i]) . ' End -->

                ';

            }
        }
    }


            $formfields .= '<tr><td colspan="2"><a type="reset" class="btn btn-info pull-right" onclick="history.back()">Back</a></td></tr></table>';
            $data = str_replace("==formfields==", $formfields, $data);
            $data = str_replace("==big_table==", ucfirst($table), $data);
            $data = str_replace("singlequote", "'", $data);

// $data = str_replace("==backscript==", "", $data);

            file_put_contents($edit_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Generator End ///////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Manage Generator Start //////////////////
//////////////////////////////////////////////////////////////////////////

            $ori_path = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $manage_file = $view_path . 'index.blade.php';
            if (file_exists($manage_file)) {
                $handle = fopen($manage_file, 'w') or die('Cannot open file:  ' . $manage_file);
            } else {
                if (!file_exists($ori_path . $table)) {
            		mkdir($ori_path . $table, 0700);
            	}
                $handle = fopen($manage_file, 'w') or die('Cannot open file:  ' . $manage_file);
            }

            $current = "";
            $myfile = fopen($controller_path . "template_files/manage.php", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/manage.php"));
            fclose($myfile);

            file_put_contents($manage_file, $current);
            $data = file_get_contents($manage_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $option_fields = "";
            $tableheadrows = '<?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?>';
            $tabledatarows = "
            <th>
            <input name='input' id='del' onclick=\"callme('show')\"  type='checkbox' class='del' value='<?php echo @@@value->==primary_key==; ?>'/>
            </th>
            <th>
            <?php echo @@@count; @@@count++; ?>
            </th>";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

        if ($_POST[$value][0] == 'select') 
        {

            $tableheadrows .= '
            <?php
             $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '"?"<i class=\'fa fa-sort-$sortSym\' aria-hidden=\'true\'></i>": "<i class=\'fa fa-sort\' aria-hidden=\'true\'></i>"; ?>

            <th> 
            <a href="<?php echo $links["' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '_link"]; ?>" class="link_css"> ' . ucwords(str_replace('_',' ',$value)) . ' <?php echo $symbol ?></a>
            </th>
				';

            $option_fields .= '<option value="' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '" <?php echo $searchBy=="' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '"?\'selected="selected"\':""; ?>>' . ucfirst($value) . '</option>';
        }
        else 
        {
            $tableheadrows .= '
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="' .$table.".". $value . '"?"<i class=\'fa fa-sort-$sortSym\' aria-hidden=\'true\'></i>": "<i class=\'fa fa-sort\' aria-hidden=\'true\'></i>"; ?>
            <th>
            <a href="<?php echo $links["' . $table.".". $value . '_link"]; ?>" class="link_css"> ' . ucwords(str_replace('_',' ',$value)) . ' <?php echo $symbol ?></a>
            </th>
			';

            $option_fields .= '<option value="' .$table.".".$value . '" <?php echo $searchBy=="' .$table.".". $value . '"?\'selected="selected"\':""; ?>>' . ucfirst($value) . '</option>';
        }




                    if ($_POST[$value][0] == 'status') 
                    {
                        $tabledatarows .= '
            <th>
            <a href="<?php echo url("/")?>/admin/' . $table . '/status/' . $value . '/<?php echo @@@value->id."?redirect=".url("/")."/admin/' . $table . '?"; ?>">
            <?php if(!empty(@@@value->' . $value . ') and @@@value->' . $value . '==1 )
            { echo "Active"; }else{ echo "Inactive";}?>
            </a>
            </th>
                ';
                    } 
                    elseif ($_POST[$value][0] == 'image') 
                    {
                        $tabledatarows .= '
            <th>
            <?php if(!empty($value->'.$value.')){ echo \'<img src="\'.$img_path.$value->'.$value.'.\'" style="width:50px;">\'; }?>
            </th>
                        ';
                    } 
                    elseif ($_POST[$value][0] == 'select') 
                    {
                        $tabledatarows .= '
            <th>
            <?php if(!empty($value->' . $_POST[$value]["value"] . ')){ echo $value->' . $_POST[$value]["value"] . '; }?>
            </th>
                        ';
                    } 
                    else 
                    {
                        $tabledatarows .= '
            <th>
            {{{ $value->' . $value . ' }}}
            </th>
                ';
                    }
                }

                //echo $_POST[$value][0]."<br>";
            }


            if (isset($_POST['one_to_many']) && !empty($_POST['one_to_many'])) {
                $all_one_to_many_relations = json_decode($_POST['one_to_many']);
                foreach ($all_one_to_many_relations as $key => $value) {
                    $one_to_many_table = $value->rel_table;
                    $one_to_many_field = $value->rel_field;

                     if (isset($one_to_many_table) && !empty($one_to_many_table)) {
                        $tableheadrows .= '<th class="action-width">'.$one_to_many_table.'</th>';
                        $tabledatarows .= '<th class="action-width">
                           <a href="<?php echo url(\'/\')?>/admin/' .$one_to_many_table.'/'.$one_to_many_field.'/<?php echo @@@value->'.$pkId.'; ?>" title="View">
                            <span class="btn btn-info " >
                                '.$one_to_many_table.'
                            </span>
                           </a>
                           </th>';
                    }
                }
            }
            


            $tabledatarows .= '
		   <th>
           <a href="<?php echo url("/"); ?>/admin/'.$table.'/view/<?php echo $value->==primary_key==?>" title="View">
            <span class="btn btn-info " ><i class="fa fa-eye"></i></span>
           </a>
           <a href="<?php echo url("/"); ?>/admin/'.$table.'/edit/<?php echo $value->==primary_key==; ?>" title="Edit">
            <span class="btn btn-info " ><i class="fa fa-edit"></i></span>
           </a>
           <a  title="Delete" data-toggle="modal" data-target="#commonDelete" onclick="$(\'#set_commondel_id\').val(\'<?php echo $value->==primary_key==; ?>\');">
           <span class="btn btn-info " ><i class="fa fa-trash-o "></i></span>
           </a>
    
            </th>';
            $row_id = " id=\"hide<?php echo @@@value->id; ?>\" ";
            $data = str_replace("==tableheadrows==", $tableheadrows, $data);
            $data = str_replace("==tabledatarows==", $tabledatarows, $data);
            $data = str_replace("==searchoptions==", $option_fields, $data);
            $data = str_replace("==table==", $table_new, $data);
            $data = str_replace("==big_table==", ucfirst($table_new), $data);
            $data = str_replace("++id++", $row_id, $data);
            $data = str_replace("@@@", "$", $data);
            $data = str_replace("==primary_key==", $pkId, $data);
            $data = str_replace("singlequote", "'", $data);

            file_put_contents($manage_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Manage Generator End ////////////////////
//////////////////////////////////////////////////////////////////////////


        $request->session()->flash('message', 'Module created Successfully!');
        return redirect()->action('GeneratorController@index');
	}



    public function one_to_many_add() {
        return view('generator/one_to_many_add',array("Tables"=>$this->getAllTables()));
    }


    public function one_to_many_add_post(Request $request) {


            $table = $_POST['table_name'];
            $pkId = $this->getPkByTable($table);
            $table_new = $_POST['table_name'];
            $cntlr = ucfirst($table);
            $base_path =  env('APP_PATH');

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Route Generator Start ////////////////////////
//////////////////////////////////////////////////////////////////////////

$file = $base_path . "/routes/web.php";
$data = file_get_contents($file);
$temp_strng = 'BO : ' . ucfirst($table);


if (strpos($data, $temp_strng) !== false) {
    echo "hi";
    $newRoute = '

   Route::get("/admin/pages/export/{type}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@postEdit\',\'middleware\' => [\'permission:item-list\']]);

   Route::get("/admin/pages/view/{id}", [ \'as\'=>\'admin.pages.view\',\'uses\'=>\'admin\PagesController@view\',\'middleware\' => [\'permission:item-list\']]);

    Route::post("/admin/pages/deleteAll", [ \'as\'=>\'admin.pages.deleteAll\',\'uses\'=>\'admin\PagesController@deleteAll\',\'middleware\' => [\'permission:item-delete\']]);

    Route::get("/admin/pages", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);

    Route::get("/admin/pages/{field}/{id}/", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);

    Route::post("/admin/pages/{field}/{id}/", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);

    Route::get("/admin/pages/add/{field}/{id}", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@getAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::get("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@getAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::post("/admin/pages/add/{field}/{id}", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@postAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::post("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@postAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::get("/admin/pages/edit/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getEdit\',\'middleware\' => [\'permission:item-edit\']]);

    Route::get("/admin/pages/edit/{edit_id}/{field}/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getEdit\',\'middleware\' => [\'permission:item-edit\']]);

    Route::get("/admin/pages/status/{field}/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@status\',\'middleware\' => [\'permission:item-edit\']]);

    Route::post("/admin/pages/edit", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@postEdit\',\'middleware\' => [\'permission:item-edit\']]);

    Route::post("/admin/pages/delete", [ \'as\'=>\'admin.pages.delete\',\'uses\'=>\'admin\PagesController@delete\',\'middleware\' => [\'permission:item-delete\']]);

    Route::post("/admin/pages/delete/{field}/{id}", [ \'as\'=>\'admin.pages.delete\',\'uses\'=>\'admin\PagesController@delete\',\'middleware\' => [\'permission:item-delete\']]);

    ';
    // Exist already, so replace routes
    $rout_table = ucfirst($table);
    $newRoute = str_replace("pages", $table, $newRoute);
    $newRoute = str_replace("Pages", ucfirst($table), $newRoute);
    $start = '// BO : '.$rout_table;
    $end   = '// EO : '.$rout_table;
    $final_data = preg_replace('#('.$start.')(.*)('.$end.')#si', '$1 '.$newRoute.' $3', $data);
    file_put_contents($file, $final_data);
} else {
    $rout_table = ucfirst($table);
    $newRoute = '

    // BO : Pages

   Route::get("/admin/pages/export/{type}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@postEdit\',\'middleware\' => [\'permission:item-list\']]);

   Route::get("/admin/pages/view/{id}", [ \'as\'=>\'admin.pages.view\',\'uses\'=>\'admin\PagesController@view\',\'middleware\' => [\'permission:item-list\']]);

    Route::post("/admin/pages/deleteAll", [ \'as\'=>\'admin.pages.deleteAll\',\'uses\'=>\'admin\PagesController@deleteAll\',\'middleware\' => [\'permission:item-delete\']]);

    Route::get("/admin/pages", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);

    Route::get("/admin/pages/{field}/{id}/", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);

    Route::post("/admin/pages/{field}/{id}/", [ \'as\'=>\'admin.pages.index\',\'uses\'=>\'admin\PagesController@index\',\'middleware\' => [\'permission:item-list|item-create|item-edit|item-delete\']]);

    Route::get("/admin/pages/add/{field}/{id}", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@getAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::get("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@getAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::post("/admin/pages/add/{field}/{id}", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@postAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::post("/admin/pages/add", [ \'as\'=>\'admin.pages.add\',\'uses\'=>\'admin\PagesController@postAdd\',\'middleware\' => [\'permission:item-create\']]);

    Route::get("/admin/pages/edit/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getEdit\',\'middleware\' => [\'permission:item-edit\']]);

    Route::get("/admin/pages/edit/{edit_id}/{field}/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@getEdit\',\'middleware\' => [\'permission:item-edit\']]);

    Route::get("/admin/pages/status/{field}/{id}", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@status\',\'middleware\' => [\'permission:item-edit\']]);

    Route::post("/admin/pages/edit", [ \'as\'=>\'admin.pages.edit\',\'uses\'=>\'admin\PagesController@postEdit\',\'middleware\' => [\'permission:item-edit\']]);

    Route::post("/admin/pages/delete", [ \'as\'=>\'admin.pages.delete\',\'uses\'=>\'admin\PagesController@delete\',\'middleware\' => [\'permission:item-delete\']]);

    Route::post("/admin/pages/delete/{field}/{id}", [ \'as\'=>\'admin.pages.delete\',\'uses\'=>\'admin\PagesController@delete\',\'middleware\' => [\'permission:item-delete\']]);
    // EO : Pages 

   // @@@@@#####@@@@@

    ';
    
    $newRoute = str_replace("pages", $table, $newRoute);
    $newRoute = str_replace("Pages", ucfirst($table), $newRoute);
    $final_data = str_replace("// @@@@@#####@@@@@", $newRoute, $data);
    file_put_contents($file, $final_data);
}


//////////////////////////////////////////////////////////////////////////
/////////////////////////// Route Generator Start ////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Menu Generator Start /////////////////////////
//////////////////////////////////////////////////////////////////////////
            $file = $base_path . "/resources/views/master.blade.php";
            $data = file_get_contents($file);
            $temp_strng = 'BO : ' . ucfirst($table);
            if (strpos($data, $temp_strng) !== false) {

            } else {
                $newMenu = '<!--  @@@@@#####@@@@@ -->';
                $newMenu = str_replace("module", $table, $newMenu);
                $newMenu = str_replace("Module", ucfirst($table), $newMenu);
                $final_data = str_replace("<!--  @@@@@#####@@@@@ -->", $newMenu, $data);
                file_put_contents($file, $final_data);
            }
//////////////////////////////////////////////////////////////////////////
/////////////////////////// Menu Generator End ///////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Controller Generator Start ///////////////////
//////////////////////////////////////////////////////////////////////////
            $controller_path = $base_path . "/app/Http/Controllers/admin/";
            $file = $controller_path . ucfirst($table) . 'Controller.php';
            $handle = fopen($file, 'w') or die('Cannot open file:  ' . $file);
            $current = "";
            $myfile = fopen($base_path . "/app/Http/Controllers/admin/template_files/controller_one_to_many.php", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/controller_one_to_many.php"));
            fclose($myfile);
            // Write the contents back to the file
            file_put_contents($file, $current);

            $data = file_get_contents($file);
            // do tag replacements or whatever you want
            $data = str_replace("=*=", "$", $data);
            $data = str_replace("=@=", "->", $data);

///////////////////////////////////////////////////////////
//////////////////// Generate Validation Start ////////////
///////////////////////////////////////////////////////////
            $alias = "";
            $select_join = "";
            $validations = array();
            $fields = "";
            $foreign_tables = '';
            $sort_fields_arr = array();
            $status_field = 'status';
            $valds = "";
            $status_field_string="";
            $status_arr = array();
            $set_value_arr = array();
            $change_status_fields="";
            $foreign_view_parameters = array();
            foreach ($_POST['ischeck'] as $key => $value) {

                if ($_POST[$value][0] == "image") {
                    $set_value_arr[] = '$'.$table.'->'.$value.' = $request->input(\''.$value.'\')=="" ? $request->input(\'old_'.$value.'\') : $request->input(\''.$value.'\') ;';
                }
                else
                {
                    $set_value_arr[] = '$'.$table.'->'.$value.' = $request->input(\''.$value.'\')!="" ? $request->input(\''.$value.'\') : "";';   
                }


                if(isset($_POST['required_'.$value]))
                {
                   $rules = implode("|", $_POST['required_'.$value]);
                   $validations[] = " '$value'=> '$rules' ";
                }
               $val_string = implode(", \n\t", $validations);

              
                $vals_str = "";


                if ($_POST[$value][0] != 'select') {
                    $sort_fields_arr[] = "'" .$table.".". $value . "'";
                    $sort_fields_arr2[] = "'" . $value . "'";
                }

                if ($_POST[$value][0] == 'select') {
                    $foreign_tables .= '$data["' . $_POST[$value]["selected_table"] . '"]=$this->' . $table . '->getListTable("' . $_POST[$value]["selected_table"] . '");';

$foreign_view_parameters[] = '\''.$_POST[$value]["selected_table"].'\'=>$'.$table.'->getAll(\''.$_POST[$value]["selected_table"].'\')';

                    $alias .= " , '" . $_POST[$value]["selected_table"] . "." . $_POST[$value]["value"] . "'";

$select_join .= '$'.$table.'->leftJoin(\''.$_POST[$value]["selected_table"].'\', \''.$table . "." . $value.'\', \'=\',\''.$_POST[$value]["selected_table"] . "." . $_POST[$value]["key"].'\');';

                    $sort_fields_arr[] = "'" . $_POST[$value]["selected_table"] . "." . $_POST[$value]["value"] . "'";
                    $sort_fields_arr2[] = "'" . $value . "'";
                }
                $cap_field = ucfirst($value);
                if ($_POST[$value][0] == "status") {

                    $change_status_fields .='
                    if($field=="'.$value.'"){
                        $status = $'.$table.'->'.$value.';
                        if($status==1){
                            $status=0;
                        } else{
                            $status=1;
                        }
                        $'.$table.'->'.$value.'=$status;
                        $'.$table.'->save();
                    }
                    ';

                    $fields .= "\t\t@@@saveData['$value'] = set_value('$value');\n";
                    $status_field = $value;
                    $status_arr[] = "'$value'";
                } 
                elseif ($_POST[$value][0] == "image") 
                {

                    $set_value_arr[] = '
                    // image upload code
                    $'.$value.'_name=\'\';
                    $'.$value.'_file = $request->file(\''.$value.'\');
                    if(!is_null($'.$value.'_file) && in_array($'.$value.'_file->getClientOriginalExtension(), $this->allow_image)){
                        $'.$value.'_name = time().\'_\'.$'.$value.'_file->getClientOriginalName();
                        $'.$value.'_file->move(\'uploads\',$'.$value.'_name);
                        $'.$table.'->'.$value.' = $'.$value.'_name;
                    }
                    ';
                } 
                elseif ($_POST[$value][0] == "checkbox") 
                {
                    $set_value_arr[] = '
                    if($request->input("'.$value.'")!=null)
                    {
                      $'.$table.'->'.$value.' = implode(",",$request->input("'.$value.'"));
                    } 
                    else
                    {
                         $'.$table.'->'.$value.'="";
                    }

                    ';
                }
                elseif ($_POST[$value][0] == "radio") 
                {
                   $fields .= "\t\t@@@saveData['$value'] = '$value';\n";
                }
                elseif($_POST[$value][0] == "radio")
                {
                   $fields .= "\t\t@@@saveData['$value'] = set_value('$value');\n";
                }
            }




    $return_multi_selected_id = "";
    $call_multi_add = "";
    $call_multi_edit = "";
    $list_tbl = "";
    $multi_selected_id = "";
    $return_multi_selected_data = "";
    if (isset($_POST["multiselect"])) {
        for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {
            if ($_POST["multiselect"]["table"][$i]) {
                $rtable = $_POST["multiselect"]["r_table"][$i];
                $field1 = $_POST["multiselect"]["r_main"][$i];
                $field2 = $_POST["multiselect"]["r_multi"][$i];

                $call_multi_add .= "\n\t\t\t@@@==table==->multiSelectInsert(\"$rtable\", \"$field2\", @@@insert_id, \"$field1\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n";

                $call_multi_edit .= "\n\t\t\t@@@==table==->multiSelectInsert(\"$rtable\", \"$field2\", @@@_POST['==primary_key=='], \"$field1\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n";

                $list_tbl .= "\t@@@data['".$_POST["multiselect"]["table"][$i]."']=@@@==table==->getAll('".$_POST["multiselect"]["table"][$i]."');\n";

                $return_multi_selected_id.= "\n\t\t\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."'] = @@@==table==->getSelectedIds(\"$rtable\", @@@id, \"$field1\", \"$field2\");\n";

                $multi_selected_id.= "\n\t\t\t@@@selected_".$_POST["multiselect"]["table"][$i]."_id = @@@==table==->getSelectedIds(\"$rtable\", @@@id, \"$field1\", \"$field2\");\n";

                $return_multi_selected_data.= "\n\t\t\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."_data'] = array();
            if (isset(@@@selected_".$_POST["multiselect"]["table"][$i]."_id) && !empty(@@@selected_".$_POST["multiselect"]["table"][$i]."_id)) {
        \n\t\t\t\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."_data'] = @@@==table==->getSelectedData('".$_POST["multiselect"]["table"][$i]."', '".$_POST["multiselect"]["value"][$i]."', @@@selected_".$_POST["multiselect"]["table"][$i]."_id);\n\t\t}\n";
            }
        }
    }
///////////////////////////////////////////////////////////
//////////////////// Generate Validation End //////////////
///////////////////////////////////////////////////////////

    $sort_fields_arr = implode(', ', $sort_fields_arr);
    $sort_fields_arr2 = implode(', ', $sort_fields_arr2);
    $data = str_replace('***foreign_table***', $foreign_tables, $data);
    $data = str_replace('==foreign_view_parameters==', implode(",",$foreign_view_parameters), $data);

    if (count($foreign_view_parameters)>0) {
        $data = str_replace('==foreign_comma_view_parameters==', ",".implode(",",$foreign_view_parameters), $data);
    }
    else {
        $data = str_replace('==foreign_comma_view_parameters==', "", $data);
    }

    $data = str_replace("==validation==", $val_string, $data);

    $data = str_replace("==call_multi_add==", $call_multi_add, $data);
    $data = str_replace("==call_multi_edit==", $call_multi_edit, $data);
    $data = str_replace("==return_multi_selected_id==", $return_multi_selected_id, $data);
    $data = str_replace("==multi_selected_id==", $multi_selected_id, $data);
    $data = str_replace("==return_multi_selected_data==", $return_multi_selected_data, $data);

    $data = str_replace("==fields==", $fields, $data);
    $data = str_replace("{{status_field}}", $status_field, $data);
    $data = str_replace("++sort_fields_arr++", $sort_fields_arr, $data);
    $data = str_replace("++sort_fields_arr2++", $sort_fields_arr2, $data);

    $data = str_replace("==list_tbl==", $list_tbl, $data);
    $data = str_replace("==table==", $table, $data);
    $data = str_replace("controller_name", ucfirst($table), $data);
    $data = str_replace("==primary_key==", $pkId, $data);
    $data = str_replace("@@@", "$", $data);

    $status_field_string = implode(", ", $status_arr);
    $data = str_replace("==status_field_string==", $status_field_string, $data);
    file_put_contents($file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Controller Generator End /////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// Model Generator Start ////////////////////////
//////////////////////////////////////////////////////////////////////////

            $model_path = $base_path. "/app/admin/";
            $file = $model_path . ucfirst($table) . '.php';
            $handle = fopen($file, 'w') or die('Cannot open file:  ' . $file);

            $current = "";
            $exist_model_path = $base_path . "/app/Http/Controllers/admin/template_files/model_one_to_many.php";
            $myfile = fopen($exist_model_path, "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($exist_model_path));
            fclose($myfile);

            // Write the contents back to the file
            file_put_contents($file, $current);


    $data = file_get_contents($file);
    $current = str_replace("@@@", "$", $data);
    $current = str_replace("++sort_fields_arr++", $sort_fields_arr, $current);
    $current = str_replace("==table==", $table, $current);
    $current = str_replace("==big_table==", ucfirst($table), $current);
    $current = str_replace("==select_alias==", $alias, $current);
    $current = str_replace("==select_join==", $select_join, $current);
    $current = str_replace("==change_status_fields==", $change_status_fields, $current);
    $current = str_replace("==set_value_arr==", implode("\n\t", $set_value_arr), $current);
    $current = str_replace("==primary_key==", $pkId, $current);

    file_put_contents($file, $current);
//////////////////////////////////////////////////////////////////////////
/////////////////////////// Model Generator End //////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Add Generator Start /////////////////////
//////////////////////////////////////////////////////////////////////////

            $ori_path = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $add_file = $view_path . 'add.blade.php';
            $edit_file = $view_path . 'edit.blade.php';
            $manage_file = $view_path . 'index.blade.php';
            if (file_exists($add_file)) {
                $handle = fopen($add_file, 'w') or die('Cannot open file:  ' . $add_file);
            } else {
                if (!file_exists($ori_path . $table)) {
                    mkdir($ori_path . $table, 0700);
                }
                $handle = fopen($add_file, 'w') or die('Cannot open file:  ' . $add_file);
            }

            $current = "";
            $myfile = fopen($controller_path . "template_files/add_one_to_many.php", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/add_one_to_many.php"));
            fclose($myfile);

            file_put_contents($add_file, $current);
            $data = file_get_contents($add_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $formfields = "";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

////////////////////////////////////////////////////
/////////// GENERATE INPUT FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    if ($_POST[$value][0] == "input") {
                        echo "input field for $value";
                        $formfields .= '


    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
      <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="' . $value . '" name="' . $value . '" 
        value="{{ old(\''.$value.'\') }}">
      </div>
      <div class="col-sm-5">
      <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div> 
    <!-- ' . ucfirst($value) . ' End -->


    ';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE INPUT FIELD FOR ADD /. /////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE DATE FIELD FOR ADD /. //////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "date") {
                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
      <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
      <div class="col-sm-4">
        <input type="text" class="form-control span2 date" id="' . $value . '" name="' . $value . '" value="{{ old(\''.$value.'\') }}">
      </div>
      <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div> 
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE DATE FIELD FOR ADD /. /////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "time") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="' . $value . '" class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control timepicker" id="' . $value . '" name="' . $value . '" value="{{ old(\''.$value.'\') }}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "datetime") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="'.$value.'" class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control datetime" id="'.$value.'" name="'.$value.'" value="{{ old(\''.$value.'\') }}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE TEXTAREA FIELD FOR ADD //////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "textarea") {
                        $formfields .= '

                <!-- ' . ucfirst($value) . ' Start -->
            <div class="form-group">
              <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
              <div class="col-sm-4">
                <textarea class="form-control" id="' . $value . '" name="' . $value . '">{{ old(\''.$value.'\') }}</textarea>
              </div>
              <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
            </div> 
            <!-- ' . ucfirst($value) . ' End -->

            ';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE TEXTAREA FIELD FOR ADD /. ///////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
////////// GENERATE SELECT FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "select") {

                        $formfields .= '
    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="'.$value.'" class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
          <select id="'.$value.'" name="'.$value.'" class="form-control select2">
            <?php
              foreach ($'.$_POST[$value]['selected_table'].' as $value) {
                echo \'<option value="\'.$value->' . $_POST[$value]['key'] . '.\'"> \'.$value->' . $_POST[$value]['value'] . '.\'</option>\';
              }
            ?>
          </select>
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
///////// ./ GENERATE SELECT FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
////////// GENERATE STATUS FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "status") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label class="control-label col-md-3">' . ucfirst($value) . '</label>
         <div class=" col-md-4 switch">
                    <div class="onoffswitch">
     <input type="checkbox" class="onoffswitch-checkbox" checked data-on-label="Yes" data-off-label="No"  name="' . $value . '" value="1" id="' . $value . '" <?php echo 1; ?> style="width:20px; height:20px;"/>
    {{ $errors->first("'.$value.'") }}
                        <label class="onoffswitch-label" for="' . $value . '">
                            <span class="onoffswitch-switch"></span>
                            <span class="onoffswitch-inner"></span>
                        </label>
                    </div>
                </div>

      </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
///////// ./ GENERATE STATUS FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE RADIO FIELD FOR ADD ///////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "radio") {
                        $formfields .= '

 <!-- ' . ucfirst($value) . ' Start -->
 <div class="form-group">
          <label class="col-sm-3 control-label">Select ' . ucfirst($value) . '</label>
          <div class="col-sm-4">';
                        $rad_arr = $_POST[$value]['radios'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
            <span style="margin-right:20px;"><input type="radio" style="width:20px; height:20px;" name="' . $value . '" value="' . $rad_arr[$aaa] . '"   @if(old(\'' . $value . '\')==\'' . $rad_arr[$aaa] . '\') checked @endif > ' . $rad_arr[$aaa] . ' </span>';
                        }
                        $formfields .= '
        </div>
        <div class="col-sm-5">
        <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
/////// ./ GENERATE RADIO FIELD FOR ADD /. /////////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE CHECKBOX FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "checkbox") {
                        $formfields .= '

 <!-- ' . ucfirst($value) . ' Start -->
 <div class="form-group">
          <label class="col-sm-3 control-label">Select ' . ucfirst($value) . '</label>
          <div class="col-sm-4">';
                        $rad_arr = $_POST[$value]['checks'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
            <span style="margin-right:20px;"><input type="checkbox"  @if(null !==old(\''.$value.'\') && in_array(\'' . $rad_arr[$aaa] . '\',old(\''.$value.'\'))) checked @endif style="width:20px; height:20px;" name="' . $value . '[]" value="' . $rad_arr[$aaa] . '"> ' . $rad_arr[$aaa] . ' </span>';
                        }
                        $formfields .= '
        </div>
        <div class="col-sm-5">
        <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
/////////// GENERATE CHECKBOX FIELD FOR ADD ////////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////////// GENERATE IMAGE FIELD FOR ADD /////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "image") {
                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
      <label for="address" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
      <div class="col-sm-6">
      <input type="file" name="' . $value . '" />
      <input type="hidden" name="old_' . $value . '" value="<?php if (isset($' . $value . ') && $' . $value . '!=""){echo $' . $value . '; } ?>" />
        <?php if(isset($' . $value . '_err) && !empty($' . $value . '_err)) 
        { foreach($' . $value . '_err as $key => $error)
        { echo "<div class=\"error-msg\"></div>"; } }?>
      </div>
        <div class="col-sm-3" >
      </div>
      <div class="col-sm-5">
        <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';

                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE IMAGE FIELD FOR ADD /. /////
////////////////////////////////////////////////////
                }

            }





if (isset($_POST["multiselect"])) {
    for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {
    
////////////////////////////////////////////////////
////////// GENERATE MULTI SELECT FIELD FOR ADD ///////////
////////////////////////////////////////////////////
    if ($_POST["multiselect"]["table"][$i]) {
    $value = $_POST["multiselect"]["table"][$i];
    $formfields .= '

      <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
              <select class="form-control select2" name="' . $value . '[]" id="' . $value . '" multiple="multiple">
              <option value="">Select ' . ucfirst($value) . '</option>
      <?php 
      if(isset($' . $value . ') && !empty($' . $value . ')):
      foreach($' . $value . ' as $key => $value): ?>
          <option value="<?php echo $value->' . $_POST["multiselect"]['key'][$i] . '; ?>">
            <?php echo $value->' . $_POST["multiselect"]['value'][$i] . '; ?>
          </option>
      <?php endforeach; ?>
      <?php endif; ?>
      </select>
        </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
}
////////////////////////////////////////////////////
///////// ./ GENERATE MULTI SELECT FIELD FOR ADD /. //////
////////////////////////////////////////////////////

    }
}



            $data = str_replace("==formfields==", $formfields, $data);
            $data = str_replace("singlequote", "'", $data);
            $data = str_replace("==table==", $table, $data);
            $data = str_replace("==big_table==", ucfirst($table), $data);
            file_put_contents($add_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Add Generator End ///////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Edit Generator Start ////////////////////
//////////////////////////////////////////////////////////////////////////
            $ori_path  = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $edit_file = $view_path . 'edit.blade.php';
            if (file_exists($edit_file)) {
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            } else {
                if (!file_exists($ori_path . $table)) {
                    mkdir($ori_path . $table, 0700);
                }
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            }

            $current = "";
            $current = file_get_contents($controller_path . "template_files/edit_one_to_many.php");
         
            file_put_contents($edit_file, $current);
            $data = file_get_contents($edit_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $formfields = "";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

////////////////////////////////////////////////////
/////////// GENERATE Edit Input FIELD FOR ADD //////
////////////////////////////////////////////////////
                    if ($_POST[$value][0] == "input") {

                        $formfields .= '

<!-- ' . ucfirst($value) . ' Start -->
<div class="form-group">
  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="' . $value . '" name="' . $value . '" 
    
    value="{{{ $data->' . $value . ' }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
</div> 
<!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
/////// ./ GENERATE Edit Input FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Textarea FIELD FOR ADD ///
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "textarea") {
                        $formfields .= '
<!-- ' . ucfirst($value) . ' Start -->

<div class="form-group">
  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
  <div class="col-sm-4">
    <textarea class="form-control" id="' . $value . '" name="' . $value . '">{{{ $data->' . $value . ' }}}</textarea>
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
</div> 

<!-- ' . ucfirst($value) . ' End -->
';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Textarea FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Date FIELD FOR ADD ///////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "date") {
                        echo "input field for $value";
                        $formfields .= '

<!-- ' . ucfirst($value) . ' Start -->
<div class="form-group">
  <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
  <div class="col-sm-4">
    <input type="text" class="form-control span2 date" id="' . $value . '" name="' . $value . '" value="{{{ $data->' . $value . ' }}}">
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
</div> 
<!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
//////// ./ GENERATE Edit Date FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "time") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="' . $value . '" class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control timepicker" id="' . $value . '" name="' . $value . '" value="{{{ $data->' . $value . ' }}}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE TIME FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "datetime") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="' . $value . '" class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control datetime" id="' . $value . '" name="' . $value . '" value="{{{ $data->' . $value . ' }}}" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
/////////// ./ GENERATE DATETIME FIELD FOR ADD /. //
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Select FIELD FOR ADD /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "select") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label for="user_id" class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
          <select id="'.$value.'" name="'.$value.'" class="form-control select2">
            <?php
              foreach ($' . $_POST[$value]['selected_table'] . ' as $value) {
                $selected = $data->'.$value.'==$value->' . $_POST[$value]['key'] . '?\'selected="selected"\':\'\';
                echo \'<option \'.$selected.\' value="\'.$value->' . $_POST[$value]['key'] . '.\'"> \'.$value->' . $_POST[$value]['value'] . '.\'</option>\';
              }
            ?>
          </select>
        </div>
        <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Select FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Status FIELD FOR ADD /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "status") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
     <div class="form-group">
        <label class="control-label col-md-3">' . ucfirst($value) . '
             
        </label>                    
         <div class=" col-md-4 switch">
                    <div class="onoffswitch">
     <input type="checkbox" class="onoffswitch-checkbox"  data-on-label="Yes" data-off-label="No"  name="' . $value . '" value="1" id="' . $value . '" <?php if($data->' . $value . ' == 1){echo "checked=checked";}?> style="width:20px; height:20px;"/>
                    </div>
                </div>
      </div>
      <!-- ' . ucfirst($value) . ' End -->

';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Status FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////////// GENERATE Edit Radio FIELD FOR ADD //////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "radio") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Select ' . ucfirst($value) . '</label>
        <div class="col-sm-4">';
                    $rad_arr = $_POST[$value]['radios'];
                    for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                        $formfields .= '
            <span style="margin-right:20px;"><input type="radio" style="width:20px; height:20px;" <?php echo $data->' . $value . '=="' . $rad_arr[$aaa] . '"?\'checked="checked"\':""; ?> name="' . $value . '" value="' . $rad_arr[$aaa] . '"> ' . $rad_arr[$aaa] . ' </span>';
                    }
                    $formfields .= '
        </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Status FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE Edit Checkbox FIELD FOR ADD /////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "checkbox") {

                        $formfields .= '

        <!-- ' . ucfirst($value) . ' Start -->
        <div class="form-group">
        <label class="col-sm-3 control-label">Select ' . ucfirst($value) . '</label>
        <div class="col-sm-4">
        <?php $arr=explode(",", $data->' . $value . ') ?>
        ';
                        $rad_arr = $_POST[$value]['checks'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
            <span style="margin-right:20px;"><input type="checkbox" style="width:20px; height:20px;" <?php echo in_array("' . $rad_arr[$aaa] . '", $arr)?\'checked="checked"\':""; ?> name="' . $value . '[]" value="' . $rad_arr[$aaa] . '"> ' . $rad_arr[$aaa] . ' </span>';
                        }

                        $formfields .= '
    </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Checkbox FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE Edit Image FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "image") {

    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
      <label for="'.$value.'" class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
        <div class="col-md-4">
          <input type="file" id="'.$value.'" name="'.$value.'" /><br>
          <?php if($data->'.$value.'!=\'\'){
            echo \'<img src="\'.url(\'/\')."/uploads/{$data->'.$value.'}".\'" style="width:100px;">\'; 
            } ?>
            <input type="hidden" name="old_'.$value.'" value="<?php echo $data->'.$value.'; ?>">
      </div>
      <div class="col-sm-5">
          <div class="label label-danger">{{ $errors->first("'.$value.'") }}</div>
      </div>
    </div>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
///// ./ GENERATE Edit Image FIELD FOR ADD /. //////
////////////////////////////////////////////////////
                }
            }



if (isset($_POST["multiselect"])) {
    for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {

////////////////////////////////////////////////////
////////// GENERATE MULTI SELECT FIELD FOR EDIT /////
////////////////////////////////////////////////////
    if ($_POST["multiselect"]["table"][$i]) {
    $value = $_POST["multiselect"]["table"][$i];
    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <div class="form-group">
        <label class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
          <div class="col-md-4">
              <select class="form-control select2" name="' . $value . '[]" id="' . $value . '" multiple="multiple">
              <option value="">Select ' . ucfirst($value) . '</option>
      <?php 
      if(isset($' . $value . ') && !empty($' . $value . ')):
      foreach($' . $value . ' as $key => $value): ?>
          <option <?php if(in_array($value->id, $selected_'.$_POST["multiselect"]["table"][$i].')){ echo "selected"; } ?> value="<?php echo $value->' . $_POST["multiselect"]['key'][$i] . '; ?>">
            <?php echo $value->' . $_POST["multiselect"]['value'][$i] . '; ?>
          </option>
      <?php endforeach; ?>
      <?php endif; ?>
      </select>
        </div>
    </div>
      <!-- ' . ucfirst($value) . ' End -->

';
}
////////////////////////////////////////////////////
////// ./ GENERATE MULTI SELECT FIELD FOR EDIT /. ///
////////////////////////////////////////////////////

    }
}


            $data = str_replace("==formfields==", $formfields, $data);
            $data = str_replace("==table==", $table, $data);
            $data = str_replace("==big_table==", ucfirst($table), $data);
            $data = str_replace("==primary_key==", $pkId, $data);
            $data = str_replace("singlequote", "'", $data);
            file_put_contents($edit_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Edit Generator End //////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Generator Start /////////////////////////
//////////////////////////////////////////////////////////////////////////

            $ori_path = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $edit_file = $view_path . 'view.blade.php';
            if (file_exists($edit_file)) {
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            } else {
                if (!file_exists($ori_path . $table)) {
                    mkdir($ori_path . $table, 0700);
                }
                $handle = fopen($edit_file, 'w') or die('Cannot open file:  ' . $edit_file);
            }

            $current = "";
            $myfile = fopen($controller_path . "template_files/view.php.tpl", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/add_one_to_many.php"));
            fclose($myfile);

            file_put_contents($edit_file, $current);
            $data = file_get_contents($edit_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $formfields = "
<table class='table table-bordered' style='width:70%;' align='center'>";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

////////////////////////////////////////////////////
///////// GENERATE Edit Input FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    if ($_POST[$value][0] == "input") {

                        $formfields .= '
    <tr>
     <td>
       <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
     </td>
     <td> 
       {{{ $data->' . $value . ' }}}
     </td>
    </tr>
    ';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Input FIELD FOR ADD /. /////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
///////// GENERATE Edit Date FIELD FOR ADD /////////
////////////////////////////////////////////////////
elseif ($_POST[$value][0] == "date" || $_POST[$value][0] == "time" || $_POST[$value][0] == "datetime") {
    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <tr>
     <td>
      <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
     </td>
     <td> 
       {{{ $data->' . $value . ' }}}
     </td>
    </tr>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
////// ./ GENERATE Edit Date FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
/////// GENERATE Edit Textarea FIELD FOR ADD ///////
////////////////////////////////////////////////////
elseif ($_POST[$value][0] == "textarea") {
                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <tr>
     <td>
      <label for="' . $value . '" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
     </td>
     <td> 
       {{{ $data->' . $value . ' }}}
     </td>
    </tr>
    <!-- ' . ucfirst($value) . ' End -->

    ';

                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Textarea FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Select FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "select") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <tr>
     <td>
      <label class="control-label col-md-3"> ' . ucfirst($value) . ' </label>
     </td>
     <td>
     {{{ $data->'.$_POST[$value]["value"].' }}}
     </td>
    </tr>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Select FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Status FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "status") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <tr>
     <td>
      <label class="control-label col-md-3">' . $value . '</label>
     </td>
     <td> 
       <?php if($data->' . $value . ' == 1){echo "Active";}else{ echo "Inactive";}?>
     </td>
    </tr>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Status FIELD FOR ADD /. //////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Radio FIELD FOR ADD /////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "radio") {

                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <tr>
     <td>
      <label class="col-sm-3 control-label">Select ' . ucfirst($value) . '</label>
     </td>
     <td> 
       ';
                        $rad_arr = $_POST[$value]['radios'];
                        for ($aaa = 0; $aaa < count($rad_arr); $aaa++) {
                            $formfields .= '
       <?php echo $data->' . $value . '=="' . $rad_arr[$aaa] . '"?\'' . $rad_arr[$aaa] . '\':""; ?>';
                        }
                        $formfields .= '
     </td>
    </tr>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Radio FIELD FOR ADD /. ///////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
////// GENERATE Edit Checkbox FIELD FOR ADD ////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "checkbox") {
                        $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <tr>
     <td>
      <label class="col-sm-3 control-label">' . ucfirst($value) . '</label>
     </td>
     <td> 
       {{{ $data->' . $value . ' }}}
     </td>
    </tr>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
//// ./ GENERATE Edit Checkbox FIELD FOR ADD /. ////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
//////// GENERATE Edit Image FIELD FOR ADD /////////
////////////////////////////////////////////////////
                    elseif ($_POST[$value][0] == "image") {
    $formfields .= '

    <!-- ' . ucfirst($value) . ' Start -->
    <tr>
     <td>
      <label for="address" class="col-sm-3 control-label"> ' . ucfirst($value) . ' </label>
     </td>
     <td>
      <?php if($data->'.$value.'!=\'\')  echo \'<img src="\'.url(\'/\').\'/uploads/\'.$data->'.$value.'.\'" style="width:100px">\'; ?></td>
     </td>
    </tr>
    <!-- ' . ucfirst($value) . ' End -->

    ';
                    }
////////////////////////////////////////////////////
///// ./ GENERATE Edit Image FIELD FOR ADD /. //////
////////////////////////////////////////////////////
                }
            }



            if (isset($_POST["multiselect"])) {
        for ($i=0; $i < count($_POST["multiselect"]["table"]); $i++) {
            if ($_POST["multiselect"]["table"][$i]) {
                $rtable = $_POST["multiselect"]["r_table"][$i];
                $field1 = $_POST["multiselect"]["r_main"][$i];
                $field2 = $_POST["multiselect"]["r_multi"][$i];
                $call_multi_add .= "\n\t@@@this->==table==->multiSelectInsert(\"$rtable\", \"$field2\", @@@insert_id, \"$field1\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n";
                $call_multi_edit .= "\n\t@@@this->==table==->multiSelectInsert(\"$rtable\", \"$field2\", @@@id, \"$field1\", @@@_POST['".$_POST["multiselect"]["table"][$i]."']);\n";
                $list_tbl .= "\n\t@@@data['".$_POST["multiselect"]["table"][$i]."']=@@@this->==table==->getList('".$_POST["multiselect"]["table"][$i]."');\n";
                $return_multi_selected_id.= "\n\t@@@data['selected_".$_POST["multiselect"]["table"][$i]."'] = @@@==table==->getSelectedIds(\"$rtable\", @@@id, \"$field1\", \"$field2\");\n";

                $formfields .= '

                <!-- ' . ucfirst($_POST["multiselect"]["table"][$i]) . ' Start -->
                <tr>
                 <td>
                  <label for="address" class="col-sm-3 control-label"> ' . ucfirst($rtable) . ' </label>
                 </td>
                 <td>
                 <?php echo implode(", ", $selected_'.$_POST["multiselect"]["table"][$i].'_data); ?>
                 </td>
                </tr>
                <!-- ' . ucfirst($_POST["multiselect"]["table"][$i]) . ' End -->

                ';

            }
        }
    }


            $formfields .= '<tr><td colspan="2"><a type="reset" class="btn btn-info pull-right" onclick="history.back()">Back</a></td></tr></table>';
            $data = str_replace("==formfields==", $formfields, $data);
            $data = str_replace("==big_table==", ucfirst($table), $data);
            $data = str_replace("singlequote", "'", $data);

// $data = str_replace("==backscript==", "", $data);

            file_put_contents($edit_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Generator End ///////////////////////////
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Manage Generator Start //////////////////
//////////////////////////////////////////////////////////////////////////

            $ori_path = $base_path . "/resources/views/admin/";
            $view_path = $ori_path."/".$table."/";
            $manage_file = $view_path . 'index.blade.php';
            if (file_exists($manage_file)) {
                $handle = fopen($manage_file, 'w') or die('Cannot open file:  ' . $manage_file);
            } else {
                if (!file_exists($ori_path . $table)) {
                    mkdir($ori_path . $table, 0700);
                }
                $handle = fopen($manage_file, 'w') or die('Cannot open file:  ' . $manage_file);
            }

            $current = "";
            $myfile = fopen($controller_path . "template_files/manage_one_to_many.php", "r") or die("Unable to open file!");
            $current = fread($myfile, filesize($controller_path . "template_files/manage_one_to_many.php"));
            fclose($myfile);

            file_put_contents($manage_file, $current);
            $data = file_get_contents($manage_file);

            $data = str_replace("@@@", "$", $data);
            $data = str_replace("cntlr", $cntlr, $data);

            $option_fields = "";
            $tableheadrows = '<?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?>';
            $tabledatarows = "
            <th>
            <input name='input' id='del' onclick=\"callme('show')\"  type='checkbox' class='del' value='<?php echo @@@value->==primary_key==; ?>'/>
            </th>
            <th>
            <?php echo @@@count; @@@count++; ?>
            </th>";
            foreach ($_POST['ischeck'] as $key => $value) {
                if (isset($value) && !empty($value)) {

        if ($_POST[$value][0] == 'select') 
        {

            $tableheadrows .= '
            <?php
             $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '"?"<i class=\'fa fa-sort-$sortSym\' aria-hidden=\'true\'></i>": "<i class=\'fa fa-sort\' aria-hidden=\'true\'></i>"; ?>

            <th> 
            <a href="<?php echo $links["' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '_link"]; ?>" class="link_css"> ' . ucfirst($value) . ' <?php echo $symbol ?></a>
            </th>
                ';

            $option_fields .= '<option value="' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '" <?php echo $searchBy=="' . $_POST[$value]["selected_table"] . '.' . $_POST[$value]["value"] . '"?\'selected="selected"\':""; ?>>' . ucfirst($value) . '</option>';
        }
        else 
        {
            $tableheadrows .= '
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="' .$table.".". $value . '"?"<i class=\'fa fa-sort-$sortSym\' aria-hidden=\'true\'></i>": "<i class=\'fa fa-sort\' aria-hidden=\'true\'></i>"; ?>
            <th>
            <a href="<?php echo $links["' . $table.".". $value . '_link"]; ?>" class="link_css"> ' . ucfirst($value) . ' <?php echo $symbol ?></a>
            </th>
            ';

            $option_fields .= '<option value="' .$table.".".$value . '" <?php echo $searchBy=="' .$table.".". $value . '"?\'selected="selected"\':""; ?>>' . ucfirst($value) . '</option>';
        }




                    if ($_POST[$value][0] == 'status') 
                    {
                        $tabledatarows .= '
            <th>
            <a href="<?php echo url("/")?>/admin/' . $table . '/status/' . $value . '/<?php echo @@@value->id."?redirect=".url("/")."/admin/' . $table . '?"; ?>">
            <?php if(!empty(@@@value->' . $value . ') and @@@value->' . $value . '==1 )
            { echo "Active"; }else{ echo "Inactive";}?>
            </a>
            </th>
                ';
                    } 
                    elseif ($_POST[$value][0] == 'image') 
                    {
                        $tabledatarows .= '
            <th>
            <?php if(!empty($value->'.$value.')){ echo \'<img src="\'.$img_path.$value->'.$value.'.\'" style="width:50px;">\'; }?>
            </th>
                        ';
                    } 
                    elseif ($_POST[$value][0] == 'select') 
                    {
                        $tabledatarows .= '
            <th>
            <?php if(!empty($value->' . $_POST[$value]["value"] . ')){ echo $value->' . $_POST[$value]["value"] . '; }?>
            </th>
                        ';
                    } 
                    else 
                    {
                        $tabledatarows .= '
            <th>
            {{{ $value->' . $value . ' }}}
            </th>
                ';
                    }
                }

                //echo $_POST[$value][0]."<br>";
            }
         
            $tabledatarows .= '
           <th>
           <a href="<?php echo url("/"); ?>/admin/'.$table.'/view/<?php echo $value->==primary_key==?>" title="View">
            <span class="btn btn-info " ><i class="fa fa-eye"></i></span>
           </a>
           <a href="<?php echo url("/"); ?>/admin/'.$table.'/edit/<?php echo $value->==primary_key==; ?>/<?php echo @@@rel_field; ?>/<?php echo @@@rel_id; ?>" title="Edit">
            <span class="btn btn-info " ><i class="fa fa-edit"></i></span>
           </a>
           <a  title="Delete" data-toggle="modal" data-target="#commonDelete" onclick="$(\'#set_commondel_id\').val(\'<?php echo $value->==primary_key==; ?>\');">
           <span class="btn btn-info " ><i class="fa fa-trash-o "></i></span>
           </a>
    
            </th>';
            $row_id = " id=\"hide<?php echo @@@value->id; ?>\" ";
            $data = str_replace("==tableheadrows==", $tableheadrows, $data);
            $data = str_replace("==tabledatarows==", $tabledatarows, $data);
            $data = str_replace("==searchoptions==", $option_fields, $data);
            $data = str_replace("==table==", $table_new, $data);
            $data = str_replace("==big_table==", ucfirst($table_new), $data);
            $data = str_replace("++id++", $row_id, $data);
            $data = str_replace("@@@", "$", $data);
            $data = str_replace("==primary_key==", $pkId, $data);
            $data = str_replace("singlequote", "'", $data);

            file_put_contents($manage_file, $data);

//////////////////////////////////////////////////////////////////////////
/////////////////////////// View Manage Generator End ////////////////////
//////////////////////////////////////////////////////////////////////////


        $request->session()->flash('message', 'Module created Successfully!');
        return redirect()->action('GeneratorController@index');
    
    }





	public function getFields()
	{
		$tbl_name = $_POST["tbl_name"];
        $fields = $this->getAllFields($tbl_name);
        echo "<table class='table table-bordered table-hover table-fixed' cellpadding='20px' cellspacing='10px'>
        <thead>
  <tr id='fixed-row'>
  <th><input type='checkbox' onclick='checkAllCheckbox();' id='checkAll'></th>
  <th>Field</th>
  <th>Validations</th>
  <th>Input</th>
  <th>Textarea</th>
  <th>Dropdown</th>
  <th>Status</th>
  <th>Image</th>
  <th>Radio</th>
  <th>Checkbox</th>
  <th>Date</th>
  <th>Time</th>
  <th>Date Time</th>
  </tr>
  </thead>
  <tbody>";
        $i = 0;
        foreach ($fields as $key => $value) {
            ?>
            <tr>

                <!-- CHECKBOX -->
                <td><input class="checked" type="checkbox" name="ischeck[]" value="<?php echo $value; ?>"></td>

                <!-- TITLE -->
                <td><?php echo $value; ?></td>

                <!-- REQUIRED -->
                <td>
<select multiple chosen class="form-control chosen-select" name="required_<?php echo $value; ?>[]" id="required_<?php echo $value; ?>[]" style="width: 150px;">
<option value="accepted">accepted</option>
<option value="active_url">active_url</option>
<option value="after:date">after:date</option>
<option value="after_or_equal:date">after_or_equal:date</option>
<option value="alpha">alpha</option>
<option value="alpha_dash">alpha_dash</option>
<option value="alpha_num">alpha_num</option>
<option value="array">array</option>
<option value="before:date">before:date</option>
<option value="before_or_equal:date">before_or_equal:date</option>
<option value="(between:min,max)">(between:min,max)</option>
<option value="boolean">boolean</option>
<option value="date">date</option>
<option value="date_format:format">date_format:format</option>
<option value="different:field">different:field</option>
<option value="digits:value">digits:value</option>
<option value="digits_between:min,max">digits_between:min,max</option>
<option value="dimensions">dimensions</option>
<option value="distinct">distinct</option>
<option value="email">email</option>
<option value="file">file</option>
<option value="filled">filled</option>
<option value="image">image</option>
<option value="integer">integer</option>
<option value="ip">ip</option>
<option value="ipv4">ipv4</option>
<option value="ipv6">ipv6</option>
<option value="json">json</option>
<option value="max:value">max:value</option>
<option value="min:value">min:value</option>
<option value="nullable">nullable</option>
<option value="required">required</option>
<option value="string">string</option>
<option value="url">url</option>
</select>
                    <!-- <input type="checkbox" name="required_<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');close_all();"> -->
                </td>

                <!-- INPUT -->
                <td><input type="radio" class="default_input" value="input" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');close_all();"></td>

                <!-- TEXTAREA -->
                <td><input type="radio" value="textarea" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');close_all();"></td>

                <!-- DROPDOWN -->
                <td>
                    <input type="radio" name="<?php echo $value; ?>[]" value="select" onclick="show_tables('table_id_<?php echo $i; ?>');setTitle('<?php echo $value; ?>');">

                    <!-- select table for dropdown -->
                    <span class="top-display" id="table_id_<?php echo $i; ?>" style="display: none">
                        Table: <select class="form-control" id="select_table_<?php echo $i; ?>" name="<?php echo $value . "[selected_table]"; ?>" onchange="show_key_value('select_table_<?php echo $i; ?>', 'table_key_id_<?php echo $i; ?>', 'table_value_id_<?php echo $i; ?>', '<?php echo $value; ?>', '<?php echo $i; ?>');">
                            <?php
                            $tables = $this->getAllTables();
                            for ($j = 0; $j < count($tables); $j++) {
                                ?>
                                <option value="<?php echo $tables[$j]; ?>"><?php echo $tables[$j] ?></option>
                            <?php } ?>
                        </select>
                        <!-- select table for key -->
                        <span id="table_key_id_<?php echo $i; ?>" style="display: none">
                        </span>
                        <!-- select table for keyvalues -->
                        <span id="table_value_id_<?php echo $i; ?>" style="display: none">
                        </span>
                    </span>

                </td>

                <!-- STATUS -->
                <td><input type="radio" value="status" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- IMAGE -->
                <td><input type="radio" value="image" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- RADIO -->
                <td>
                    <input type="radio" value="radio" name="<?php echo $value; ?>[]" onclick="select_radio('radio_span_<?php echo $i; ?>', '<?php echo $i; ?>');
                            setTitle('<?php echo $value; ?>');">
                    <table class="top-display" id="radio_span_<?php echo $i; ?>" style="display: none;">
                        <tr><td colspan="2"><a href="javascript:void(0)" onclick="setTitleRadio('<?php echo $value; ?>');
                                add_more_radio('radio_span_<?php echo $i; ?>');"><b>Add</b></a></td></tr>
                        <tr>
                            <td><input type="text" value="Radio" name="<?php echo $value; ?>[radios][]"></td>
                            <td></td>
                        </tr>
                    </table>
                </td>

                <!-- CHECKBOX -->
                <td><input type="radio" value="checkbox" name="<?php echo $value; ?>[]" onclick="select_check('check_span_<?php echo $i; ?>', '<?php echo $i; ?>');
                           ">
                    <table class="top-display" id="check_span_<?php echo $i; ?>" style="display: none;">
                        <tr><td colspan="2"><a href="javascript:void(0)" onclick="setTitleCheck('<?php echo $value; ?>');add_more_check('check_span_<?php echo $i; ?>');"><b>Add</b></a></td></tr>
                        <tr>
                            <td><input value="Checkbox" type="text" name="<?php echo $value; ?>[checks][]"></td>
                            <td></td>
                        </tr>
                    </table>
                </td>

                <!-- DATE -->
                <td><input type="radio" value="date" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- TIME -->
                <td><input type="radio" value="time" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- DATETIME -->
                <td><input type="radio" value="datetime" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
        </table>

        <br>

        <!-- Multi Select -->
        <button type="button" name="<?php echo $value; ?>[]" value="multi_select" onclick="add_multi_table();" class="btn btn-info">
        Many To Many</button>

        <!-- One To Many -->
        <button type="button" name="<?php echo $value; ?>[]" value="single_select" onclick="get_table_dropdown();" class="btn btn-info">
        One To Many</button>

        <br>
        <div id="result_multi_table"></div>
        <br>
        <div id="result_one_many_table"></div>
        <br>


        <input type="hidden" name="mode" value="generate">

        <input type="hidden" id="selected_check_field">

        <input type="hidden" id="selected_radio">
        <input type="hidden" id="radio_id">
        <input type="hidden" id="selected_field_radio">

        <input type="hidden" id="selected_check">
        <input type="hidden" id="check_id">
        <input type="hidden" id="selected_field_check">
        <input type="hidden" id="one_to_many" name="one_to_many">
        <input type="hidden" id="accet_url" value="<?php echo url('/'); ?>/accets/">
        <?php
    }



    public function getFieldsOneToMany()
    {

        $tbl_name = $_POST["tbl_name"];
        $fields = $this->getAllFields($tbl_name);
        echo "<table class='table table-bordered table-hover table-fixed' cellpadding='20px' cellspacing='10px'>
        <thead>
  <tr id='fixed-row'>
  <th><input type='checkbox' onclick='checkAllCheckbox();' id='checkAll'></th>
  <th>Field</th>
  <th>Validations</th>
  <th>Input</th>
  <th>Textarea</th>
  <th>Dropdown</th>
  <th>Status</th>
  <th>Image</th>
  <th>Radio</th>
  <th>Checkbox</th>
  <th>Date</th>
  <th>Time</th>
  <th>Date Time</th>
  </tr>
  </thead>
  <tbody>";
        $i = 0;
        foreach ($fields as $key => $value) {
            ?>
            <tr>

                <!-- CHECKBOX -->
                <td><input class="checked" type="checkbox" name="ischeck[]" value="<?php echo $value; ?>"></td>

                <!-- TITLE -->
                <td><?php echo $value; ?></td>

                <!-- REQUIRED -->
                <td>
<select multiple chosen class="form-control chosen-select" name="required_<?php echo $value; ?>[]" id="required_<?php echo $value; ?>[]" style="width: 150px;">
<option value="accepted">accepted</option>
<option value="active_url">active_url</option>
<option value="after:date">after:date</option>
<option value="after_or_equal:date">after_or_equal:date</option>
<option value="alpha">alpha</option>
<option value="alpha_dash">alpha_dash</option>
<option value="alpha_num">alpha_num</option>
<option value="array">array</option>
<option value="before:date">before:date</option>
<option value="before_or_equal:date">before_or_equal:date</option>
<option value="(between:min,max)">(between:min,max)</option>
<option value="boolean">boolean</option>
<option value="date">date</option>
<option value="date_format:format">date_format:format</option>
<option value="different:field">different:field</option>
<option value="digits:value">digits:value</option>
<option value="digits_between:min,max">digits_between:min,max</option>
<option value="dimensions">dimensions</option>
<option value="distinct">distinct</option>
<option value="email">email</option>
<option value="file">file</option>
<option value="filled">filled</option>
<option value="image">image</option>
<option value="integer">integer</option>
<option value="ip">ip</option>
<option value="ipv4">ipv4</option>
<option value="ipv6">ipv6</option>
<option value="json">json</option>
<option value="max:value">max:value</option>
<option value="min:value">min:value</option>
<option value="nullable">nullable</option>
<option value="required">required</option>
<option value="string">string</option>
<option value="url">url</option>
</select>
                    <!-- <input type="checkbox" name="required_<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');close_all();"> -->
                </td>

                <!-- INPUT -->
                <td><input type="radio" class="default_input" value="input" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');close_all();"></td>

                <!-- TEXTAREA -->
                <td><input type="radio" value="textarea" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');close_all();"></td>

                <!-- DROPDOWN -->
                <td>
                    <input type="radio" name="<?php echo $value; ?>[]" value="select" onclick="show_tables('table_id_<?php echo $i; ?>');setTitle('<?php echo $value; ?>');">

                    <!-- select table for dropdown -->
                    <span class="top-display" id="table_id_<?php echo $i; ?>" style="display: none">
                        Table: <select class="form-control" id="select_table_<?php echo $i; ?>" name="<?php echo $value . "[selected_table]"; ?>" onchange="show_key_value('select_table_<?php echo $i; ?>', 'table_key_id_<?php echo $i; ?>', 'table_value_id_<?php echo $i; ?>', '<?php echo $value; ?>', '<?php echo $i; ?>');">
                            <?php
                            $tables = $this->getAllTables();
                            for ($j = 0; $j < count($tables); $j++) {
                                ?>
                                <option value="<?php echo $tables[$j]; ?>"><?php echo $tables[$j] ?></option>
                            <?php 
                             } ?>
                        </select>
                        <!-- select table for key -->
                        <span id="table_key_id_<?php echo $i; ?>" style="display: none">
                        </span>
                        <!-- select table for keyvalues -->
                        <span id="table_value_id_<?php echo $i; ?>" style="display: none">
                        </span>
                    </span>

                </td>

                <!-- STATUS -->
                <td><input type="radio" value="status" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- IMAGE -->
                <td><input type="radio" value="image" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- RADIO -->
                <td>
                    <input type="radio" value="radio" name="<?php echo $value; ?>[]" onclick="select_radio('radio_span_<?php echo $i; ?>', '<?php echo $i; ?>');
                            setTitle('<?php echo $value; ?>');">
                    <table class="top-display" id="radio_span_<?php echo $i; ?>" style="display: none;">
                        <tr><td colspan="2"><a href="javascript:void(0)" onclick="setTitleRadio('<?php echo $value; ?>');
                                add_more_radio('radio_span_<?php echo $i; ?>');"><b>Add</b></a></td></tr>
                        <tr>
                            <td><input type="text" value="Radio" name="<?php echo $value; ?>[radios][]"></td>
                            <td></td>
                        </tr>
                    </table>
                </td>

                <!-- CHECKBOX -->
                <td><input type="radio" value="checkbox" name="<?php echo $value; ?>[]" onclick="select_check('check_span_<?php echo $i; ?>', '<?php echo $i; ?>');
                           ">
                    <table class="top-display" id="check_span_<?php echo $i; ?>" style="display: none;">
                        <tr><td colspan="2"><a href="javascript:void(0)" onclick="setTitleCheck('<?php echo $value; ?>');add_more_check('check_span_<?php echo $i; ?>');"><b>Add</b></a></td></tr>
                        <tr>
                            <td><input value="Checkbox" type="text" name="<?php echo $value; ?>[checks][]"></td>
                            <td></td>
                        </tr>
                    </table>
                </td>

                <!-- DATE -->
                <td><input type="radio" value="date" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- TIME -->
                <td><input type="radio" value="time" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

                <!-- DATETIME -->
                <td><input type="radio" value="datetime" name="<?php echo $value; ?>[]" onclick="setTitle('<?php echo $value; ?>');"></td>

            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
        </table>

        <br>

    

        <input type="hidden" name="mode" value="generate">

        <input type="hidden" id="selected_check_field">

        <input type="hidden" id="selected_radio">
        <input type="hidden" id="radio_id">
        <input type="hidden" id="selected_field_radio">

        <input type="hidden" id="selected_check">
        <input type="hidden" id="check_id">
        <input type="hidden" id="selected_field_check">
        <input type="hidden" id="one_to_many" name="one_to_many">
        <input type="hidden" id="accet_url" value="<?php echo url('/'); ?>/accets/">
        <?php
    }



    public function get_multi_table_html()
    { ?>

    <table class="table multi_table_box" style="border-collapse: collapse;">
                <tr>
                    <td colspan="4"><center><h1>Many To Many<img src="<?php echo url('/'); ?>/accets/img/button-cross_basic_red.png" onclick="delete_multi_table(this);" style="float: right;"></h1></center></td>

                </tr>
                   <tr>
                     <td>
                    <!-- select table for dropdown -->
                    <span class="top-display">
                      Multi Select Table: <a href="javascript:void(0);" data-toggle="popover" data-content="A second table that relate to current selected table. Eg: products and category."><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                      <select class="form-control multi_table" name="multiselect[table][]" onchange="populate_key_val(this, 'multi_key', 'multi_value', '');">
                            <option value="">-Select Table-</option>
                            <?php
                            $tables = $this->getAllTables();
                            for ($j = 0; $j < count($tables); $j++) {
                                ?>
                                <option value="<?php echo $tables[$j]; ?>"><?php echo $tables[$j] ?></option>
                            <?php 
                             } ?>
                        </select>
                    </span>
                    </td>
                    <td>
                        <!-- select table for key -->
                        <span class="multi_key"></span>
                    </td>
                    <td>
                        <!-- select table for values -->
                        <span class="multi_value"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <!-- select table for multi Relatoin -->
                    <span class="top-display multi_relation_table">
                       Relational Table: 
                       <select class="form-control multi_relation_table" name="multiselect[r_table][]" onchange="popuplate_multi_get_key_value(this,'multi_relation_key','multi_relation_value','relation');">
                        <option value="">-Select Table-</option>
                            <?php
                            $tables = $this->getAllTables();
                            for ($j = 0; $j < count($tables); $j++) {
                                if(!in_array($tables[$j], array('ci_sessions', 'users'))){
                                ?>
                                <option value="<?php echo $tables[$j]; ?>"><?php echo $tables[$j] ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                    <td>
                        <!-- select table for key -->
                        <span class="multi_relation_key"></span>
                    </td>
                    <td>
                        <!-- select table for keyvalues -->
                        <span class="multi_relation_value"></span>
                </td>
            </tr>
        </table>
    <?php
    exit;
    }

    public function popuplate_multi_get_key_value() {
        $dropdown_tbl = $_POST["table"];
        $parent_table = $_POST["parent_table"];
        $multi_table = $_POST["multi_table"];
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
        Key:<a href="javascript:void(0);" data-toggle="popover" data-content="<?php echo $parent_table; ?> id"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        <select class="form-control multi_select_key" name="multiselect[key][]">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <?php
        echo '==##==';
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        echo $_POST["table"];
        ?>
        id : <a href="javascript:void(0);" data-toggle="popover" data-content="<?php echo $multi_table; ?> id"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        <select class="form-control multi_select_value" name="multiselect[value][]">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <?php
        exit;
    }

    public function multi_get_key_value() {
        $dropdown_tbl = $_POST["table"];
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
        Key:
        <select class="form-control multi_select_key" name="multiselect[key][]">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <?php
        echo '==##==';
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
        value : 
        <select class="form-control multi_select_value" name="multiselect[value][]">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <?php
        exit;
    }
   

    function r_get_key_value() {
        $dropdown_tbl = $_POST["table"];
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
        Key:<select class="form-control multi_select_key" name="multiselect[r_main][]">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <?php
        echo '==##==';
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
        Value:<select class="form-control multi_select_value" name="multiselect[r_multi][]">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <?php
        exit;
    }



    function getKeyValue() {
        $dropdown_tbl = $_POST["dropdown_tbl"];
        $field = $_POST["field"];
        $id = $_POST["id"];
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
        Key:<select class="form-control" id="key_<?php echo $id; ?>" name="<?php echo $field . "[key]"; ?>">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <?php
        echo '==##==';
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
        Value:<select class="form-control" id="value_<?php echo $id; ?>" name="<?php echo $field . "[value]"; ?>">
            <?php foreach ($fields as $key => $value) { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php $i++; } ?>
        </select>
        <?php
	}


    function get_table_dropdown()
    {
        ?>
         <br>
        <div class="form-group" class="">
            <span rowspan="2" valign="center"><img src="<?php echo url('/'); ?>/accets/img/button-cross_basic_red.png" onclick="delete_one_to_many(this);" style="float: right;"></span>
            <center><h1>One To Many</h1></center>
        <hr>
            <iframe  id="myIframe" src="<?php echo url('/'); ?>/generator/one_to_many_add" style="width: 100%; height: 400px;"></iframe>
        </div>
        <?php 
        exit;
    }


    function get_key_dropdown() {
        $dropdown_tbl = $_POST["dropdown_tbl"];
        $parent_table = $_POST["parent_table"];
        $fields = $this->getAllFields($dropdown_tbl);
        $i = 0;
        ?>
            <label for="Module_name" class="col-sm-3 control-label"> Related Field </label>
            <div class="col-sm-4">

                Select Field : <a href="javascript:void(0);" data-toggle="popover" data-content="<?php echo $parent_table; ?> id"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                <select class="form-control" id="related_field" name="related_field">
                    <option value="">-Select Table-</option>
                    <?php foreach ($fields as $key => $value) { ?>
                        
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                        <?php $i++; } ?>
                </select>
            </div>
        <?php exit;
    }

}