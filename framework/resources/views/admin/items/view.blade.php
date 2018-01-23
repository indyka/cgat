@extends('master')

@section('content')


<!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Items</h1>
<?php if(isset($data)){ ?>
<form action="controller/pages_submit.php" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" >
      
<table class='table table-bordered' style='width:70%;' align='center'>
    <tr>
     <td>
       <label for="description" class="col-sm-3 control-label"> Description </label>
     </td>
     <td> 
       {{{ $data->description }}}
     </td>
    </tr>
    
    <tr>
     <td>
       <label for="created_at" class="col-sm-3 control-label"> Created_at </label>
     </td>
     <td> 
       {{{ $data->created_at }}}
     </td>
    </tr>
    
    <tr>
     <td>
       <label for="updated_at" class="col-sm-3 control-label"> Updated_at </label>
     </td>
     <td> 
       {{{ $data->updated_at }}}
     </td>
    </tr>
    <tr><td colspan="2"><a type="reset" class="btn btn-info pull-right" onclick="history.back()">Back</a></td></tr></table>
    </table>
  </div>

  
</form>
<?php } else{
    echo '<h2 align="center" class="text-danger">No record found!</h2>';
  } ?>


    </div>
  </div>
</div>
<!-- /page content -->


@endsection
