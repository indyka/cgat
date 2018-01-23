@extends('master')

@section('content')
<!-- demo content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Demo</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/demo/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $data->id; ?>">


<!-- Image Start -->
<div class="form-group">
  <label for="image" class="col-sm-3 control-label"> Image </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="image" name="image" 
    
    value="{{{ $data->image }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("image") }}</div>
      </div>
</div> 
<!-- Image End -->



<!-- Name Start -->
<div class="form-group">
  <label for="name" class="col-sm-3 control-label"> Name </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="name" name="name" 
    
    value="{{{ $data->name }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("name") }}</div>
      </div>
</div> 
<!-- Name End -->



<!-- Address Start -->
<div class="form-group">
  <label for="address" class="col-sm-3 control-label"> Address </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="address" name="address" 
    
    value="{{{ $data->address }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("address") }}</div>
      </div>
</div> 
<!-- Address End -->


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
<!-- /demo content -->
@endsection