@extends('master')

@section('content')
<!-- pages content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Pages</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/pages/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $data->id; ?>">


<!-- User_id Start -->
<div class="form-group">
  <label for="user_id" class="col-sm-3 control-label"> User Id </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="user_id" name="user_id" 
    
    value="{{{ $data->user_id }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("user_id") }}</div>
      </div>
</div> 
<!-- User_id End -->



<!-- Theme_id Start -->
<div class="form-group">
  <label for="theme_id" class="col-sm-3 control-label"> Theme Id </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="theme_id" name="theme_id" 
    
    value="{{{ $data->theme_id }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("theme_id") }}</div>
      </div>
</div> 
<!-- Theme_id End -->


  <div class="form-group">
  <div class="col-sm-3">
  </div>
   <div class="col-sm-6">
    <button type="reset" class="btn btn-default ">Reset</button>
    <button type="submit" class="btn btn-info ">Submit</button>
   </div>
  </div>
</form>
<?php } else{
    echo '<h2 align="center" class="text-danger">No record found!</h2>';
  } ?>
    </div>
  </div>
</div>
<!-- /pages content -->
@endsection