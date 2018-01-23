<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\controller_name;
use DB;
use Illuminate\Support\Facades\Input;
class controller_nameController extends Controller
{
    public @@@v_fields=array(++sort_fields_arr++);
    public @@@allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request @@@request){
        @@@sortBy='';
        @@@order = '';
        @@@searchBy='';
        @@@searchValue='';

        // order
        if(isset(@@@_GET['sortBy']) && in_array(@@@_GET['sortBy'], @@@this->v_fields)){
            @@@sortBy=@@@_GET['sortBy'];
            @@@order = isset(@@@_GET['order']) && @@@_GET['order']=='asc'?'asc':'desc';
            if(isset(@@@_GET['order']) && @@@_GET['order']!=''){
                @@@_GET['order']=@@@_GET['order']=='asc'?'desc':'asc';
            } else{
                @@@_GET['order']='desc';
            }
        }

        // create links for field
        @@@get_q = @@@_GET;
        foreach (@@@this->v_fields as @@@key => @@@value) {
          @@@get_q['sortBy'] = @@@value;
          @@@get_q['page']=1;
          @@@query_result = http_build_query(@@@get_q);
          @@@links[@@@value.'_link'] =url('/').'/admin/==table==?'.@@@query_result;
        }
        @@@links['csvlink'] = url('/').'/admin/==table==/export/csv?';
        @@@links['pdflink'] = url('/').'/admin/==table==/export/pdf?';

        // pagination per page
        @@@per_page = isset(@@@_GET['per_page'])?@@@_GET['per_page']:5;

        // search value
        if(isset(@@@_GET['searchBy']) && in_array(@@@_GET['searchBy'], @@@this->v_fields) && @@@_GET['searchValue']!=''){
            @@@searchBy=@@@_GET['searchBy'];
            @@@searchValue = @@@_GET['searchValue'];
        }

        // get by modal
        @@@==table== = new \App\admin\controller_name;
        @@@data = @@@==table==->getcontroller_nameData(@@@per_page, @@@searchBy, @@@searchValue, @@@sortBy, @@@order);

        return view('admin/==table==/index', ['data'=>@@@data->appends(Input::except('page')), 'per_page'=>@@@per_page, 'links'=>@@@links]);
    }



    public function getAdd(Request @@@request){
        @@@==table== = new \App\admin\controller_name;
        @@@data = array(==foreign_view_parameters==);
        ==list_tbl==
    	return view('admin/==table==/add', @@@data);
    }

    public function postEdit(Request @@@request){

        @@@this->validate(@@@request, [
            ==validation==
        ]);

        @@@==table== = new \App\admin\controller_name;
        if(@@@==table==->updatecontroller_name(@@@request)){
            ==call_multi_edit==
            @@@request->session()->flash('message', 'controller_name Updated successfully!');
            return redirect()->action('admin\controller_nameController@index');
        } else{
            @@@request->session()->flash('message', 'Error: Invalid record!');
            return redirect()->action('admin\controller_nameController@index');
        }
    }

    public function postAdd(Request @@@request){

        @@@this->validate(@@@request, [
            ==validation==
        ]);

        @@@==table== = new \App\admin\controller_name;

        @@@insert_id = @@@==table==->addcontroller_name(@@@request);

        
             ==call_multi_add==
       

        @@@request->session()->flash('message', 'controller_name added successfully!');
        return redirect()->action('admin\controller_nameController@index');
    }

    public function getEdit(@@@id=''){
        
        @@@==table== = new \App\admin\controller_name;
        @@@data = array(==foreign_comma_view_parameters==);

        ==list_tbl==
        ==return_multi_selected_id==
        @@@data['data'] = @@@==table==->getcontroller_name(@@@id);
        if(count(@@@data)){
            return view('admin/==table==/edit', @@@data);
        } else{
            return view('admin/==table==/edit');
        }
    }

    public function view(@@@id){
        @@@==table== = new \App\admin\controller_name;
        @@@data['data'] = @@@==table==->getcontroller_nameView(@@@id);
        ==multi_selected_id==
        ==return_multi_selected_data==
        if(count(@@@data)){
            return view('admin/==table==/view', @@@data);
        } else{
            return view('admin/==table==/view');
        }
    }

    public function status(Request @@@request, @@@field, @@@id){
        @@@==table== = new \App\admin\controller_name;
        @@@flag = @@@==table==->changeStatus(@@@field, @@@id);
        @@@redirect = @@@_GET["redirect"];
        if(@@@flag){
            @@@request->session()->flash('message', 'Status changed successfully!');
            return redirect(@@@redirect);
        } else{
            @@@request->session()->flash('message', 'Invalid id!');
            return redirect()->action('admin\controller_nameController@index');
        }
    }

    public function delete(Request @@@request){
    	@@@id = @@@request->input('==primary_key==');
        @@@==table== = new \App\admin\controller_name;
        @@@flag = @@@==table==->deleteOne(@@@id);
        if(@@@flag){
            @@@request->session()->flash('message', 'controller_name deleted successfully!');
            if(@@@request->input('redirect')!=''){
                return redirect(urldecode(@@@request->input('redirect')));
            } else{
                return redirect()->action('admin\controller_nameController@index');
            }
        } else{
            @@@request->session()->flash('message', 'Invalid id!');
            return redirect()->action('admin\controller_nameController@index');
        }
    }

    public function deleteAll(Request @@@request)
    {
        @@@allIds = @@@request->input('allIds');
        @@@flag = false;
        @@@==table== = new \App\admin\controller_name;
        for(@@@i=0; @@@i<count(@@@allIds); @@@i++)
        {
            if(@@@allIds[@@@i]!="")
            {
                @@@id = @@@allIds[@@@i];
                @@@flag = @@@==table==->deleteOne(@@@id);                
            }
        }

        if(@@@flag){
            @@@request->session()->flash('message', 'Demo deleted successfully!');
        }
    }

    public function getExport(@@@type){
        @@@sortBy='';
        @@@order = '';
        @@@searchBy='';
        @@@searchValue='';

        // search query
        if(isset(@@@_GET['searchBy']) && in_array(@@@_GET['searchBy'], @@@this->v_fields) && @@@_GET['searchValue']!=''){
            @@@searchBy = @@@_GET['searchBy'];
            @@@searchValue = @@@_GET['searchValue'];
        }

        // sort by
        if(isset(@@@_GET['sortBy']) && in_array(@@@_GET['sortBy'], @@@this->v_fields)){
            @@@sortBy=@@@_GET['sortBy'];
            @@@order = isset(@@@_GET['order']) && @@@_GET['order']=='asc'?'asc':'desc';
        }

        @@@==table== = new \App\admin\controller_name;
        @@@data = @@@==table==->getcontroller_nameExport(@@@searchBy, @@@searchValue, @@@sortBy, @@@order);

        if(@@@type=='csv'){
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename===table==.csv');
            header('Pragma: no-cache');
            @@@csv='Sr. No,'.implode(',', @@@this->v_fields)."\n";
            foreach (@@@data as @@@key => @@@value) {
                @@@line=(@@@key+1).',';
                foreach (@@@this->v_fields as @@@field) {
                    @@@field = explode('.', @@@field);
                    @@@field = end(@@@field);
                    @@@line.='"'.@@@value->@@@field.'"'.',';
                }
                @@@csv.=ltrim(@@@line,',')."\n";
            }
            echo @@@csv; exit;
        } elseif(@@@type=='pdf'){
            require_once(app_path().'/libraries/mpdf60/mpdf.php');
            @@@table='
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
            <h1 align="center">==table==</h1>
            <table><tr>';
            @@@table.='<th>Sr. No</th>';
            foreach (@@@this->v_fields as @@@value) {
                @@@table.='<th>'.@@@value.'</th>';
            }
            @@@table.='</tr>';
            foreach (@@@data as @@@key => @@@value) {
                @@@table.='<tr><td>'.(@@@key+1).'</td>';
                foreach (@@@this->v_fields as @@@field) {
                    @@@field = explode('.', @@@field);
                    @@@field = end(@@@field);
                    @@@table.='<td>'.@@@value->@@@field.'</td>';
                }
                @@@table.='</tr>';
            }
            @@@table.='</table></body></html>';
            @@@pdf = new \mPDF();
            @@@pdf->WriteHTML(@@@table);
            @@@pdf->Output('==table==.pdf', "D");
            exit;
        } else{
            echo 'Invalid option!';
        }
    }
}
