<?php $__env->startSection('content'); ?>
<!-- items content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Items</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/items/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="id" value="<?php echo $data->id; ?>">


<!-- Title Start -->
<div class="form-group">
  <label for="title" class="col-sm-3 control-label"> Title </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="title" name="title" 
    
    value="<?php echo e($data->title); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("title")); ?></div>
      </div>
</div> 
<!-- Title End -->


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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>