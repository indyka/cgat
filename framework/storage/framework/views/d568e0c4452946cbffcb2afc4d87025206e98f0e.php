<?php $__env->startSection('content'); ?>
<!-- theme_options content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Theme_options</h1>
<?php if(isset($data)){ ?>
<form action="<?php echo url('/'); ?>/admin/theme_options/edit" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="t_id" value="<?php echo $data->t_id; ?>">


<!-- User_id Start -->
<div class="form-group">
  <label for="user_id" class="col-sm-3 control-label"> User_id </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="user_id" name="user_id" 
    
    value="<?php echo e($data->user_id); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("user_id")); ?></div>
      </div>
</div> 
<!-- User_id End -->



<!-- Theme_id Start -->
<div class="form-group">
  <label for="theme_id" class="col-sm-3 control-label"> Theme_id </label>
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



<!-- Site_name Start -->
<div class="form-group">
  <label for="site_name" class="col-sm-3 control-label"> Site_name </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="site_name" name="site_name" 
    
    value="<?php echo e($data->site_name); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("site_name")); ?></div>
      </div>
</div> 
<!-- Site_name End -->



<!-- Logo_url Start -->
<div class="form-group">
  <label for="logo_url" class="col-sm-3 control-label"> Logo_url </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="logo_url" name="logo_url" 
    
    value="<?php echo e($data->logo_url); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("logo_url")); ?></div>
      </div>
</div> 
<!-- Logo_url End -->



<!-- Email Start -->
<div class="form-group">
  <label for="email" class="col-sm-3 control-label"> Email </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="email" name="email" 
    
    value="<?php echo e($data->email); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("email")); ?></div>
      </div>
</div> 
<!-- Email End -->



<!-- Contact_no Start -->
<div class="form-group">
  <label for="contact_no" class="col-sm-3 control-label"> Contact_no </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="contact_no" name="contact_no" 
    
    value="<?php echo e($data->contact_no); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("contact_no")); ?></div>
      </div>
</div> 
<!-- Contact_no End -->



<!-- Address Start -->
<div class="form-group">
  <label for="address" class="col-sm-3 control-label"> Address </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="address" name="address" 
    
    value="<?php echo e($data->address); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("address")); ?></div>
      </div>
</div> 
<!-- Address End -->



<!-- Background_music Start -->
<div class="form-group">
  <label for="background_music" class="col-sm-3 control-label"> Background_music </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="background_music" name="background_music" 
    
    value="<?php echo e($data->background_music); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("background_music")); ?></div>
      </div>
</div> 
<!-- Background_music End -->



<!-- Base_url Start -->
<div class="form-group">
  <label for="base_url" class="col-sm-3 control-label"> Base_url </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="base_url" name="base_url" 
    
    value="<?php echo e($data->base_url); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("base_url")); ?></div>
      </div>
</div> 
<!-- Base_url End -->



<!-- Domain Start -->
<div class="form-group">
  <label for="domain" class="col-sm-3 control-label"> Domain </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="domain" name="domain" 
    
    value="<?php echo e($data->domain); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("domain")); ?></div>
      </div>
</div> 
<!-- Domain End -->



<!-- Created Start -->
<div class="form-group">
  <label for="created" class="col-sm-3 control-label"> Created </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="created" name="created" 
    
    value="<?php echo e($data->created); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("created")); ?></div>
      </div>
</div> 
<!-- Created End -->



<!-- Modified Start -->
<div class="form-group">
  <label for="modified" class="col-sm-3 control-label"> Modified </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="modified" name="modified" 
    
    value="<?php echo e($data->modified); ?>"
    >
  </div>
  <div class="col-sm-5">
         <div class="label label-danger"><?php echo e($errors->first("modified")); ?></div>
      </div>
</div> 
<!-- Modified End -->


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
<!-- /theme_options content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>