@extends('master')

@section('content')
  <!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Items</h1>

<form action="<?php echo url('/'); ?>/admin/items/add/<?php echo $rel_field; ?>/<?php echo $rel_id; ?>" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
{{ csrf_field() }}

    


    <!-- Description Start -->
    <div class="form-group">
      <label for="description" class="col-sm-3 control-label"> Description </label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="description" name="description" 
        value="{{ old('description') }}">
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
        value="{{ old('created_at') }}">
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
        value="{{ old('updated_at') }}">
      </div>
      <div class="col-sm-5">
      <div class="label label-danger">{{ $errors->first("updated_at") }}</div>
      </div>
    </div> 
    <!-- Updated_at End -->


    

  <div class="form-group">
    <div class="col-sm-3" >
      </div>
      <div class="col-sm-6">
    <input type="hidden" name="rel_field" id="rel_field" value="<?php echo $rel_field; ?>">
    <input type="hidden" name="rel_id" id="rel_id" value="<?php echo $rel_id; ?>">
    <button type="reset" class="btn btn-default ">Reset</button>
    <button type="submit" class="btn btn-info ">Submit</button>
      </div>
        <div class="col-sm-3" >
      </div>
  </div>
</form>



    </div>
  </div>
</div>
<!-- /page content -->
@endsection

