<?php $__env->startSection('content'); ?>

<?php
$searchValue = isset($_GET['searchValue'])?$_GET['searchValue']:'';
$searchBy = isset($_GET['searchBy'])?$_GET['searchBy']:'';
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'';
$order = isset($_GET['order'])?$_GET['order']:'';
$redirect = url('/').'/admin/vishal?'.urlencode($_SERVER["QUERY_STRING"]);


?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="row x_panel">
      <?php if(Session::has('message')): ?>
          <div class="alert alert-success">
              <button type="button" class="close" data-close="alert"></button>
               <?php echo e(Session::get('message')); ?>

          </div>
    <?php endif; ?>
    <div class="pull-right">
      <a href="<?php echo $links['csvlink']; ?>" class="btn btn-success">CSV</a>
      <a href="<?php echo $links['pdflink']; ?>" class="btn btn-success">PDF</a>
    </div>
    <div class="pull-left">
      <a href="<?php echo url('/'); ?>/admin/vishal/add" class="btn btn-success">Add Vishal</a>
    </div>
    <br>
    <hr>

    <form method="GET" action="" class="form-inline ibox-content">
        <div class="form-group">
          <select name="searchBy" class="form-control">
           <option value="vishal.last_name" <?php echo $searchBy=="vishal.last_name"?'selected="selected"':""; ?>>Last_name</option><option value="vishal.contact_name" <?php echo $searchBy=="vishal.contact_name"?'selected="selected"':""; ?>>Contact_name</option><option value="vishal.age" <?php echo $searchBy=="vishal.age"?'selected="selected"':""; ?>>Age</option><option value="vishal.address" <?php echo $searchBy=="vishal.address"?'selected="selected"':""; ?>>Address</option><option value="vishal.profile" <?php echo $searchBy=="vishal.profile"?'selected="selected"':""; ?>>Profile</option><option value="vishal.sex" <?php echo $searchBy=="vishal.sex"?'selected="selected"':""; ?>>Sex</option><option value="vishal.hobbies" <?php echo $searchBy=="vishal.hobbies"?'selected="selected"':""; ?>>Hobbies</option><option value="vishal.date" <?php echo $searchBy=="vishal.date"?'selected="selected"':""; ?>>Date</option><option value="vishal.time" <?php echo $searchBy=="vishal.time"?'selected="selected"':""; ?>>Time</option><option value="vishal.created" <?php echo $searchBy=="vishal.created"?'selected="selected"':""; ?>>Created</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" name="searchValue" id="searchValue" class="form-control" value="<?php echo $searchValue; ?>">
        </div>
        <input type="submit" name="search" value="Search" class="btn btn-info">
        <div class="form-group pull-right">
          <select name="per_page" class="form-control" onchange="this.form.submit()">
            <option value="5" <?php echo $per_page=="5"?'selected="selected"':""; ?>>5</option>
            <option value="10" <?php echo $per_page=="10"?'selected="selected"':""; ?>>10</option>
            <option value="20" <?php echo $per_page=="20"?'selected="selected"':""; ?>>20</option>
            <option value="50" <?php echo $per_page=="50"?'selected="selected"':""; ?>>50</option>
            <option value="100" <?php echo $per_page=="100"?'selected="selected"':""; ?>>100</option>
          </select>
        </div>
      </form>

              <hr>

    <div class="col-md-12 col-sm-12 col-xs-12">
    <h1>Vishal</h1>
    <br>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover Tax" >
      <thead>
      <th><input onclick="toggle(this,'cbgroup1')" id="foo[]" name="foo[]" type="checkbox" value="" /></th>
       <th> Sr No. </th>
          <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?>
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.last_name"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.last_name_link"]; ?>" class="link_css"> Last_name <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.contact_name"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.contact_name_link"]; ?>" class="link_css"> Contact_name <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.age"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.age_link"]; ?>" class="link_css"> Age <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.address"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.address_link"]; ?>" class="link_css"> Address <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.profile"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.profile_link"]; ?>" class="link_css"> Profile <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.sex"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.sex_link"]; ?>" class="link_css"> Sex <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.hobbies"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.hobbies_link"]; ?>" class="link_css"> Hobbies <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.date"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.date_link"]; ?>" class="link_css"> Date <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.time"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.time_link"]; ?>" class="link_css"> Time <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="vishal.created"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["vishal.created_link"]; ?>" class="link_css"> Created <?php echo $symbol ?></a>
            </th>
			
          <th></th>
      </thead>
      <tbody>
      <?php $count=1;
            $img_path=url('/').'/uploads/';
          foreach($data as $value){
           ?>
          <tr id="hide<?php $value->id; ?>" >
            
            <th>
            <input name='input' id='del' onclick="callme('show')"  type='checkbox' class='del' value='<?php echo $value->id; ?>'/>
            </th>
            <th>
            <?php if(!empty($value->id)){ echo $count; $count++; }?>
            </th>
            <th>
            <?php echo e($value->last_name); ?>

            </th>
                
            <th>
            <?php echo e($value->contact_name); ?>

            </th>
                
            <th>
            <?php echo e($value->age); ?>

            </th>
                
            <th>
            <?php echo e($value->address); ?>

            </th>
                
            <th>
            <?php echo e($value->profile); ?>

            </th>
                
            <th>
            <?php echo e($value->sex); ?>

            </th>
                
            <th>
            <?php echo e($value->hobbies); ?>

            </th>
                
            <th>
            <?php echo e($value->date); ?>

            </th>
                
            <th>
            <?php echo e($value->time); ?>

            </th>
                
            <th>
            <?php echo e($value->created); ?>

            </th>
                
		   <th>
           <a href="<?php echo url("/"); ?>/admin/vishal/view/<?php echo $value->id?>" title="View">
            <span class="btn btn-info " ><i class="fa fa-eye"></i></span>
           </a>
           <a href="<?php echo url("/"); ?>/admin/vishal/edit/<?php echo $value->id; ?>" title="Edit">
            <span class="btn btn-info " ><i class="fa fa-edit"></i></span>
           </a>
           <a  title="Delete" data-toggle="modal" data-target="#commonDelete" onclick="$('#set_commondel_id').val('<?php echo $value->id; ?>');">
           <span class="btn btn-info " ><i class="fa fa-trash-o "></i></span>
           </a>
    
            </th>
                </tr>
                   <?php
                  }
                if($count<=1){
                  echo '<tr><td colspan="100"><h3 align="center" class="text-danger">No Record found!</center</td></tr>';
                } ?>
            </tbody>
            </table>
            <?php echo e($data->links('vendor.pagination.default')); ?>

            </div>

    </div>
  </div>
</div>
<img onclick="callme('','item','')" src="<?php echo url('/')?>/accets/img/mac-trashcan_full-new.png" id="recycle" style="width:90px;  display:none; position:fixed; bottom: 50px; right: 50px;"/>
<!-- /page content -->

<!-- Common Delete Popup  -->
<div class="modal fade" id="commonDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <form action="<?php echo url('/'); ?>/admin/vishal/delete" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="frm_title">Delete</h4>
      </div>
      <div class="modal-body" id="frm_body">
   Do you really want to delete?
    <input type="hidden" id="set_commondel_id" name="id">
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>">
    <?php echo e(csrf_field()); ?>

    </div>
      <div class="modal-footer">
        <button style='margin-left:10px;' type="submit" class="btn btn-primary col-sm-2 pull-right" id="frm_submit">Yes</button>
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      </div>
    </div>
  </div>
</form>
</div>
<!-- ./ Common Delete Popup /. -->

<script type="text/javascript">
   function delRow()
   {var confrm = confirm("Are you sure you want to delete?");
     if(confrm)
     {
       ids = values();
       $.ajax({
         type:"POST",
         url:'<?php echo url("/")."/admin/vishal/deleteAll"; ?>',
         data:{
          allIds:ids,
          _token:"<?php echo e(csrf_token()); ?>",
         },
         success:function(res){
           location.reload();
           },
       });
     }
   }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>