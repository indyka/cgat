<?php $__env->startSection('content'); ?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Theme_options</h1>
<?php if(isset($data)){ ?>
<form action="controller/pages_submit.php" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" >
      
<table class='table table-bordered' style='width:70%;' align='center'>
	<tr>
	 <td>
	   <label for="user_id" class="col-sm-3 control-label"> User_id </label>
	 </td>
	 <td> 
	   <?php echo e($data->user_id); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="theme_id" class="col-sm-3 control-label"> Theme_id </label>
	 </td>
	 <td> 
	   <?php echo e($data->theme_id); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="site_name" class="col-sm-3 control-label"> Site_name </label>
	 </td>
	 <td> 
	   <?php echo e($data->site_name); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="logo_url" class="col-sm-3 control-label"> Logo_url </label>
	 </td>
	 <td> 
	   <?php echo e($data->logo_url); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="email" class="col-sm-3 control-label"> Email </label>
	 </td>
	 <td> 
	   <?php echo e($data->email); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="contact_no" class="col-sm-3 control-label"> Contact_no </label>
	 </td>
	 <td> 
	   <?php echo e($data->contact_no); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="address" class="col-sm-3 control-label"> Address </label>
	 </td>
	 <td> 
	   <?php echo e($data->address); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="background_music" class="col-sm-3 control-label"> Background_music </label>
	 </td>
	 <td> 
	   <?php echo e($data->background_music); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="base_url" class="col-sm-3 control-label"> Base_url </label>
	 </td>
	 <td> 
	   <?php echo e($data->base_url); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="domain" class="col-sm-3 control-label"> Domain </label>
	 </td>
	 <td> 
	   <?php echo e($data->domain); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="created" class="col-sm-3 control-label"> Created </label>
	 </td>
	 <td> 
	   <?php echo e($data->created); ?>

	 </td>
	</tr>
	
	<tr>
	 <td>
	   <label for="modified" class="col-sm-3 control-label"> Modified </label>
	 </td>
	 <td> 
	   <?php echo e($data->modified); ?>

	 </td>
	</tr>
	<tr><td colspan="2"><a type="reset" class="btn btn-info pull-right" onclick="history.back()">Back</a></td></tr></table>
    </table>
  </div>

  
</form>
<?php } else{
    echo '<h2 align="center" class="text-danger">No record found!</h2>';
  } ?>


    </div>
  </div>
</div>
<!-- /page content -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>