@extends('master')

@section('content')
<!-- items content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Items</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/items/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $data->id; ?>">


<!-- Description Start -->
<div class="form-group">
  <label for="description" class="col-sm-3 control-label"> Description </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="description" name="description" 
    
    value="{{{ $data->description }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("description") }}</div>
      </div>
</div> 
<!-- Description End -->



<!-- Created_at Start -->
<div class="form-group">
  <label for="created_at" class="col-sm-3 control-label"> Created_at </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="created_at" name="created_at" 
    
    value="{{{ $data->created_at }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("created_at") }}</div>
      </div>
</div> 
<!-- Created_at End -->



<!-- Updated_at Start -->
<div class="form-group">
  <label for="updated_at" class="col-sm-3 control-label"> Updated_at </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="updated_at" name="updated_at" 
    
    value="{{{ $data->updated_at }}}"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger">{{ $errors->first("updated_at") }}</div>
      </div>
</div> 
<!-- Updated_at End -->


  <div class="form-group">
  <div class="col-sm-3">
  </div>
   <div class="col-sm-6">
    <input type="hidden" name="rel_field" id="rel_field" value="<?php echo $rel_field; ?>">
    <input type="hidden" name="rel_id" id="rel_id" value="<?php echo $rel_id; ?>">
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
<!-- /items content -->
@endsection