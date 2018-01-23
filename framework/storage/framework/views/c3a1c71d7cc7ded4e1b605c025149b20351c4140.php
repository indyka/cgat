<?php $__env->startSection('content'); ?>
<!-- demo content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Demo</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/demo/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="id" value="<?php echo $data->id; ?>">


	<!-- User_id Start -->
    <div class="form-group">
        <label for="user_id" class="control-label col-md-3"> User_id </label>
          <div class="col-md-4">
          <select id="user_id" name="user_id" class="form-control select2">
            <?php
              foreach ($users as $value) {
                $selected = $data->user_id==$value->id?'selected="selected"':'';
                echo '<option '.$selected.' value="'.$value->id.'"> '.$value->name.'</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("user_id")); ?></div>
      </div>
    </div>
      <!-- User_id End -->


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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>