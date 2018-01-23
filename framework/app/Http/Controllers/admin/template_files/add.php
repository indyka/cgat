@extends('master')

@section('content')
  <!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>==big_table==</h1>

<form action="<?php echo url('/'); ?>/admin/==table==/add" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
{{ csrf_field() }}

    ==formfields==

  <div class="form-group">
    <div class="col-sm-3" >
      </div>
      <div class="col-sm-6">
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

