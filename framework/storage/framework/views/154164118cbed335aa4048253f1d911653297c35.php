<?php $__env->startSection('content'); ?>
  <!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Demo</h1>

<form action="<?php echo url('/'); ?>/admin/demo/add" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>


    
	<!-- User_id Start -->
    <div class="form-group">
        <label for="user_id" class="control-label col-md-3"> User_id </label>
          <div class="col-md-4">
          <select id="user_id" name="user_id" class="form-control select2">
            <?php
              foreach ($users as $value) {
                echo '<option value="'.$value->id.'"> '.$value->name.'</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("user_id")); ?></div>
      </div>
    </div>
      <!-- User_id End -->



    <!-- Image Start -->
    <div class="form-group">
      <label for="address" class="col-sm-3 control-label"> Image </label>
      <div class="col-sm-6">
      <input type="file" name="image" />
      <input type="hidden" name="old_image" value="<?php if (isset($image) && $image!=""){echo $image; } ?>" />
        <?php if(isset($image_err) && !empty($image_err)) 
        { foreach($image_err as $key => $error)
        { echo "<div class=\"error-msg\"></div>"; } }?>
      </div>
        <div class="col-sm-3" >
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
			    <textarea class="form-control" id="address" name="address"><?php echo e(old('address')); ?></textarea>
			  </div>
			  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("address")); ?></div>
      </div>
			</div> 
			<!-- Address End -->

			

	<!-- Status Start -->
	<div class="form-group">
        <label class="control-label col-md-3">Status</label>
         <div class=" col-md-4 switch">
                    <div class="onoffswitch">
     <input type="checkbox" class="onoffswitch-checkbox" checked data-on-label="Yes" data-off-label="No"  name="status" value="1" id="status" <?php echo 1; ?> style="width:20px; height:20px;"/>
    <?php echo e($errors->first("status")); ?>

                        <label class="onoffswitch-label" for="status">
                            <span class="onoffswitch-switch"></span>
                            <span class="onoffswitch-inner"></span>
                        </label>
                    </div>
                </div>

      </div>
      <!-- Status End -->



 <!-- Sex Start -->
 <div class="form-group">
          <label class="col-sm-3 control-label">Select Sex</label>
          <div class="col-sm-4">
            <span style="margin-right:20px;"><input type="radio" style="width:20px; height:20px;" name="sex" value="Male"   <?php if(old('sex')=='Male'): ?> checked <?php endif; ?> > Male </span>
            <span style="margin-right:20px;"><input type="radio" style="width:20px; height:20px;" name="sex" value="Female"   <?php if(old('sex')=='Female'): ?> checked <?php endif; ?> > Female </span>
        </div>
        <div class="col-sm-5">
        <div class="label label-danger"><?php echo e($errors->first("sex")); ?></div>
      </div>
    </div>
      <!-- Sex End -->



 <!-- Hoby Start -->
 <div class="form-group">
          <label class="col-sm-3 control-label">Select Hoby</label>
          <div class="col-sm-4">
            <span style="margin-right:20px;"><input type="checkbox"  <?php if(null !==old('hoby') && in_array('Dance',old('hoby'))): ?> checked <?php endif; ?> style="width:20px; height:20px;" name="hoby[]" value="Dance"> Dance </span>
            <span style="margin-right:20px;"><input type="checkbox"  <?php if(null !==old('hoby') && in_array('Music',old('hoby'))): ?> checked <?php endif; ?> style="width:20px; height:20px;" name="hoby[]" value="Music"> Music </span>
        </div>
        <div class="col-sm-5">
        <div class="label label-danger"><?php echo e($errors->first("hoby")); ?></div>
      </div>
    </div>
      <!-- Hoby End -->



	<!-- Date Start -->
	<div class="form-group">
	  <label for="date" class="col-sm-3 control-label"> Date </label>
	  <div class="col-sm-4">
	    <input type="text" class="form-control span2 date" id="date" name="date" value="<?php echo e(old('date')); ?>">
	  </div>
	  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("date")); ?></div>
      </div>
	</div> 
	<!-- Date End -->

	

	<!-- Time Start -->
    <div class="form-group">
        <label for="time" class="control-label col-md-3"> Time </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control timepicker" id="time" name="time" value="<?php echo e(old('time')); ?>" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("time")); ?></div>
      </div>
    </div>
	<!-- Time End -->

	

	<!-- Datetime Start -->
    <div class="form-group">
        <label for="datetime" class="control-label col-md-3"> Datetime </label>
          <div class="col-md-4">
            <input type="text" autocomplete="off" class="form-control datetime" id="datetime" name="datetime" value="<?php echo e(old('datetime')); ?>" >
        </div>
        <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("datetime")); ?></div>
      </div>
    </div>
	<!-- Datetime End -->

	

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