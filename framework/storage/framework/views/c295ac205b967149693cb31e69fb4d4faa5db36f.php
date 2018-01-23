

<?php $__env->startSection('content'); ?>
<!-- pages content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Pages</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/pages/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="id" value="<?php echo $data->id; ?>">


	<!-- User_id Start -->
    <div class="form-group">
        <label for="user_id" class="control-label col-md-3"> User Id </label>
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



<!-- Theme_id Start -->
<div class="form-group">
  <label for="theme_id" class="col-sm-3 control-label"> Theme Id </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="theme_id" name="theme_id" 
    
    value="<?php echo e($data->theme_id); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("theme_id")); ?></div>
      </div>
</div> 
<!-- Theme_id End -->


<!-- Page_title Start -->

<div class="form-group">
  <label for="page_title" class="col-sm-3 control-label"> Page Title </label>
  <div class="col-sm-4">
    <textarea class="form-control" id="page_title" name="page_title"><?php echo e($data->page_title); ?></textarea>
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("page_title")); ?></div>
      </div>
</div> 

<!-- Page_title End -->


	<!-- Descreption Start -->
	 <div class="form-group">
        <label class="control-label col-md-3">Descreption
             
        </label>                    
         <div class=" col-md-4 switch">
                    <div class="onoffswitch">
     <input type="checkbox" class="onoffswitch-checkbox"  data-on-label="Yes" data-off-label="No"  name="descreption" value="1" id="descreption" <?php if($data->descreption == 1){echo "checked=checked";}?> style="width:20px; height:20px;"/>
                    </div>
                </div>
      </div>
      <!-- Descreption End -->



    <!-- Meta_title Start -->
    <div class="form-group">
      <label for="meta_title" class="control-label col-md-3"> Meta Title </label>
        <div class="col-md-4">
          <input type="file" id="meta_title" name="meta_title" /><br>
          <?php if($data->meta_title!=''){
            echo '<img src="'.url('/')."/uploads/{$data->meta_title}".'" style="width:100px;">'; 
            } ?>
            <input type="hidden" name="old_meta_title" value="<?php echo $data->meta_title; ?>">
      </div>
      <div class="col-sm-5">
          <div class="label label-danger"><?php echo e($errors->first("meta_title")); ?></div>
      </div>
    </div>
    <!-- Meta_title End -->

    

<!-- Meta_descreption Start -->
<div class="form-group">
  <label for="meta_descreption" class="col-sm-3 control-label"> Meta Descreption </label>
  <div class="col-sm-4">
    <input type="text" class="form-control span2 date" id="meta_descreption" name="meta_descreption" value="<?php echo e($data->meta_descreption); ?>">
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("meta_descreption")); ?></div>
      </div>
</div> 
<!-- Meta_descreption End -->


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
<!-- /pages content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>