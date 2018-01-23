<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Items;
use DB;
use Illuminate\Support\Facades\Input;
class ItemsController extends Controller
{   
    public $v_fields=array('items.description', 'items.created_at', 'items.updated_at');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){
        $rel_id = request()->segment(count(request()->segments()));
        $rel_field = request()->segment(count(request()->segments())-1);
        $sortBy='';
        $order = '';
        $searchBy='';
        $searchValue='';

        // order
        if(isset($_GET['sortBy']) && in_array($_GET['sortBy'], $this->v_fields)){
            $sortBy=$_GET['sortBy'];
            $order = isset($_GET['order']) && $_GET['order']=='asc'?'asc':'desc';
            if(isset($_GET['order']) && $_GET['order']!=''){
                $_GET['order']=$_GET['order']=='asc'?'desc':'asc';
            } else{
                $_GET['order']='desc';
            }
        }

        // create links for field
        $get_q = $_GET;
        foreach ($this->v_fields as $key => $value) {
          $get_q['sortBy'] = $value;
          $get_q['page']=1;
          $query_result = http_build_query($get_q);
          $links[$value.'_link'] =url('/').'/admin/items?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/items/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/items/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:5;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $items = new \App\admin\Items;
        $data = $items->getItemsData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/items/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links, 'rel_field'=>$rel_field, 'rel_id'=>$rel_id]);
    }



    public function getAdd(Request $request){
        $data = array();
        $data['rel_field'] =  request()->segment(count(request()->segments())-1);
        $data['rel_id'] = request()->segment(count(request()->segments()));
        $items = new \App\admin\Items;
        
    	return view('admin/items/add', $data);
    }

    public function postEdit(Request $request){
        $rel_field = $_POST['rel_field'];
        $rel_id = $_POST['rel_id'];
        $this->validate($request, [
            
        ]);

        $items = new \App\admin\Items;
        if($items->updateItems($request)){
            
            $request->session()->flash('message', 'Items Updated successfully!');
            return redirect()->action('admin\ItemsController@index', [$rel_field, $rel_id]);
        } else{
            $request->session()->flash('message', 'Error: Invalid record!');
            return redirect()->action('admin\ItemsController@index', [$rel_field, $rel_id]);
        }
    }

    public function postAdd(Request $request) {
        $rel_field = $_POST['rel_field'];
        $rel_id = $_POST['rel_id'];
        $this->validate($request, [
            
        ]);

        $items = new \App\admin\Items;

        $insert_id = $items->addItems($request);
        
        $request->session()->flash('message', 'Items added successfully!');
        return redirect()->action('admin\ItemsController@index', [$rel_field, $rel_id]);
    }

    public function getEdit($id='') {
        $data = array();
        $data['rel_field'] =  request()->segment(count(request()->segments())-1);
        $data['rel_id'] = request()->segment(count(request()->segments()));
        $items = new \App\admin\Items;
        //$users = $items->getAll('items');
        
        
        $data['data'] = $items->getItems($id);
        if(count($data)){
            return view('admin/items/edit', $data);
        } else{
            return view('admin/items/edit');
        }
    }

    public function view($id){
        $items = new \App\admin\Items;
        $data['data'] = $items->getItemsView($id);
        
        
        if(count($data)){
            return view('admin/items/view', $data);
        } else{
            return view('admin/items/view');
        }
    }

    public function status(Request $request, $field, $id){
        $items = new \App\admin\Items;
        $flag = $items->changeStatus($field, $id);
        $redirect = $_GET["redirect"];
        if($flag){
            $request->session()->flash('message', 'Status changed successfully!');
            return redirect($redirect);
        } else{
            $request->session()->flash('message', 'Invalid id!');
            return redirect()->action('admin\ItemsController@index');
        }
    }

    public function delete(Request $request){
        $rel_field = $_POST['rel_field'];
        $rel_id = $_POST['rel_id'];
    	$id = $request->input('id');
        $items = new \App\admin\Items;
        $flag = $items->deleteOne($id);
        if($flag){
            $request->session()->flash('message', 'Items deleted successfully!');
            if($request->input('redirect')!=''){
                return redirect(urldecode($request->input('redirect')));
            } else{
                return redirect()->action('admin\ItemsController@index', [$rel_field, $rel_id]);
            }
        } else{
            $request->session()->flash('message', 'Invalid id!');
            return redirect()->action('admin\ItemsController@index', [$rel_field, $rel_id]);
        }
    }

    public function deleteAll(Request $request)
    {
        $allIds = $request->input('allIds');
        $flag = false;
        $items = new \App\admin\Items;
        for($i=0; $i<count($allIds); $i++)
        {
            if($allIds[$i]!="")
            {
                $id = $allIds[$i];
                $flag = $items->deleteOne($id);                
            }
        }

        if($flag){
            $request->session()->flash('message', 'Demo deleted successfully!');
        }
    }

    public function getExport($type){
        $sortBy='';
        $order = '';
        $searchBy='';
        $searchValue='';

        // search query
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy = $_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // sort by
        if(isset($_GET['sortBy']) && in_array($_GET['sortBy'], $this->v_fields)){
            $sortBy=$_GET['sortBy'];
            $order = isset($_GET['order']) && $_GET['order']=='asc'?'asc':'desc';
        }

        $items = new \App\admin\Items;
        $data = $items->getItemsExport($searchBy, $searchValue, $sortBy, $order);

        if($type=='csv'){
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename=items.csv');
            header('Pragma: no-cache');
            $csv='Sr. No,'.implode(',', $this->v_fields)."\n";
            foreach ($data as $key => $value) {
                $line=($key+1).',';
                foreach ($this->v_fields as $field) {
                    $field = explode('.', $field);
                    $field = end($field);
                    $line.='"'.$value->$field.'"'.',';
                }
                $csv.=ltrim($line,',')."\n";
            }
            echo $csv; exit;
        } elseif($type=='pdf'){
            require_once(app_path().'/libraries/mpdf60/mpdf.php');
            $table='
            <html>
            <head><title></title>
            <style>
            table{
                border:1px solid;
            }
            tr:nth-child(even)
            {
                background-color: rgba(158, 158, 158, 0.82);
            }
            </style>
            </head>
            <body>
            <h1 align="center">items</h1>
            <table><tr>';
            $table.='<th>Sr. No</th>';
            foreach ($this->v_fields as $value) {
                $table.='<th>'.$value.'</th>';
            }
            $table.='</tr>';
            foreach ($data as $key => $value) {
                $table.='<tr><td>'.($key+1).'</td>';
                foreach ($this->v_fields as $field) {
                    $field = explode('.', $field);
                    $field = end($field);
                    $table.='<td>'.$value->$field.'</td>';
                }
                $table.='</tr>';
            }
            $table.='</table></body></html>';
            $pdf = new \mPDF();
            $pdf->WriteHTML($table);
            $pdf->Output('items.pdf', "D");
            exit;
        } else{
            echo 'Invalid option!';
        }
    }
}
