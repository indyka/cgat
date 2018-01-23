<?php $__env->startSection('content'); ?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Pages</h1>
<?php if(isset($data)){ ?>
<form action="controller/pages_submit.php" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" >
      
<table class='table table-bordered' style='width:70%;' align='center'>
	<tr>
	 <td>
	   <label for="page_title" class="col-sm-3 control-label"> Page_title </label>
	 </td>
	 <td> 
	   <?php echo e($data->page_title); ?>

	 </td>
	</tr>
	

    <!-- Descreption Start -->
	<tr>
	 <td>
	  <label for="descreption" class="col-sm-3 control-label"> Descreption </label>
	 </td>
	 <td> 
	   <?php echo e($data->descreption); ?>

	 </td>
	</tr>
    <!-- Descreption End -->

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