<?php $__env->startSection('content'); ?>
<!-- category content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Category</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/category/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="cat_id" value="<?php echo $data->cat_id; ?>">


<!-- Name Start -->
<div class="form-group">
  <label for="name" class="col-sm-3 control-label"> Name </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="name" name="name" 
    
    value="<?php echo e($data->name); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("name")); ?></div>
      </div>
</div> 
<!-- Name End -->



    <!-- Products Start -->
    <div class="form-group">
        <label class="control-label col-md-3"> Products </label>
          <div class="col-md-4">
              <select class="form-control select2" name="products[]" id="products" multiple="multiple">
              <option value="">Select Products</option>
      <?php 
      if(isset($products) && !empty($products)):
      foreach($products as $key => $value): ?>
          <option <?php if(in_array($value->pro_id, $selected_products)){ echo "selected"; } ?> value="<?php echo $value->pro_id; ?>">
            <?php echo $value->name; ?>
          </option>
      <?php endforeach; ?>
      <?php endif; ?>
      </select>
        </div>
    </div>
      <!-- Products End -->


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
<!-- /category content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>