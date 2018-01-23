@extends('master')

@section('content')
<!-- ==table== content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>==big_table==</h1>
<?php if(isset(@@@data)){ ?>
<form action="<?php echo url('/'); ?>/admin/==table==/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="==primary_key==" value="<?php echo @@@data->==primary_key==; ?>">
==formfields==
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
<!-- /==table== content -->
@endsection