

<?php $__env->startSection('content'); ?>
  <!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Demo</h1>

<form action="<?php echo url('/'); ?>/admin/demo/add" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>


    


	<!-- Image Start -->
	<div class="form-group">
	  <label for="image" class="col-sm-3 control-label"> Image </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control" id="image" name="image" 
	    value="<?php echo e(old('image')); ?>">
	  </div>
	  <div class="col-sm-5">
      <div class="label label-danger"><?php echo e($errors->first("image")); ?></div>
      </div>
	</div> 
	<!-- Image End -->


	


	<!-- Name Start -->
	<div class="form-group">
	  <label for="name" class="col-sm-3 control-label"> Name </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control" id="name" name="name" 
	    value="<?php echo e(old('name')); ?>">
	  </div>
	  <div class="col-sm-5">
      <div class="label label-danger"><?php echo e($errors->first("name")); ?></div>
      </div>
	</div> 
	<!-- Name End -->


	


	<!-- Address Start -->
	<div class="form-group">
	  <label for="address" class="col-sm-3 control-label"> Address </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control" id="address" name="address" 
	    value="<?php echo e(old('address')); ?>">
	  </div>
	  <div class="col-sm-5">
      <div class="label label-danger"><?php echo e($errors->first("address")); ?></div>
      </div>
	</div> 
	<!-- Address End -->


	

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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>