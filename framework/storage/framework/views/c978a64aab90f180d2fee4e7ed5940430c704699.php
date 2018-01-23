

<?php $__env->startSection('content'); ?>
  <!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Pages</h1>

<form action="<?php echo url('/'); ?>/admin/pages/add" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>


    


	<!-- User_id Start -->
	<div class="form-group">
	  <label for="user_id" class="col-sm-3 control-label"> User Id </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control" id="user_id" name="user_id" 
	    value="<?php echo e(old('user_id')); ?>">
	  </div>
	  <div class="col-sm-5">
      <div class="label label-danger"><?php echo e($errors->first("user_id")); ?></div>
      </div>
	</div> 
	<!-- User_id End -->


	


	<!-- Theme_id Start -->
	<div class="form-group">
	  <label for="theme_id" class="col-sm-3 control-label"> Theme Id </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control" id="theme_id" name="theme_id" 
	    value="<?php echo e(old('theme_id')); ?>">
	  </div>
	  <div class="col-sm-5">
      <div class="label label-danger"><?php echo e($errors->first("theme_id")); ?></div>
      </div>
	</div> 
	<!-- Theme_id End -->


	

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