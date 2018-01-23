<?php $__env->startSection('content'); ?>

<?php
$searchValue = isset($_GET['searchValue'])?$_GET['searchValue']:'';
$searchBy = isset($_GET['searchBy'])?$_GET['searchBy']:'';
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'';
$order = isset($_GET['order'])?$_GET['order']:'';
$redirect = url('/').'/admin/theme_options?'.urlencode($_SERVER["QUERY_STRING"]);


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
      <a href="<?php echo url('/'); ?>/admin/theme_options/add" class="btn btn-success">Add Theme_options</a>
    </div>
    <br>
    <hr>

    <form method="GET" action="" class="form-inline ibox-content">
        <div class="form-group">
          <select name="searchBy" class="form-control">
           <option value="theme_options.user_id" <?php echo $searchBy=="theme_options.user_id"?'selected="selected"':""; ?>>User_id</option><option value="theme_options.theme_id" <?php echo $searchBy=="theme_options.theme_id"?'selected="selected"':""; ?>>Theme_id</option><option value="theme_options.site_name" <?php echo $searchBy=="theme_options.site_name"?'selected="selected"':""; ?>>Site_name</option><option value="theme_options.logo_url" <?php echo $searchBy=="theme_options.logo_url"?'selected="selected"':""; ?>>Logo_url</option><option value="theme_options.email" <?php echo $searchBy=="theme_options.email"?'selected="selected"':""; ?>>Email</option><option value="theme_options.contact_no" <?php echo $searchBy=="theme_options.contact_no"?'selected="selected"':""; ?>>Contact_no</option><option value="theme_options.address" <?php echo $searchBy=="theme_options.address"?'selected="selected"':""; ?>>Address</option><option value="theme_options.background_music" <?php echo $searchBy=="theme_options.background_music"?'selected="selected"':""; ?>>Background_music</option><option value="theme_options.base_url" <?php echo $searchBy=="theme_options.base_url"?'selected="selected"':""; ?>>Base_url</option><option value="theme_options.domain" <?php echo $searchBy=="theme_options.domain"?'selected="selected"':""; ?>>Domain</option><option value="theme_options.created" <?php echo $searchBy=="theme_options.created"?'selected="selected"':""; ?>>Created</option><option value="theme_options.modified" <?php echo $searchBy=="theme_options.modified"?'selected="selected"':""; ?>>Modified</option>
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
    <h1>Theme_options</h1>
    <br>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover Tax" >
      <thead>
      <th><input onclick="toggle(this,'cbgroup1')" id="foo[]" name="foo[]" type="checkbox" value="" /></th>
       <th> Sr No. </th>
          <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?>
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.user_id"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.user_id_link"]; ?>" class="link_css"> User_id <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.theme_id"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.theme_id_link"]; ?>" class="link_css"> Theme_id <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.site_name"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.site_name_link"]; ?>" class="link_css"> Site_name <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.logo_url"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.logo_url_link"]; ?>" class="link_css"> Logo_url <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.email"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.email_link"]; ?>" class="link_css"> Email <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.contact_no"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.contact_no_link"]; ?>" class="link_css"> Contact_no <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.address"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.address_link"]; ?>" class="link_css"> Address <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.background_music"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.background_music_link"]; ?>" class="link_css"> Background_music <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.base_url"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.base_url_link"]; ?>" class="link_css"> Base_url <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.domain"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.domain_link"]; ?>" class="link_css"> Domain <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.created"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.created_link"]; ?>" class="link_css"> Created <?php echo $symbol ?></a>
            </th>
			
            <?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"]=="theme_options.modified"?"<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>": "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>
            <th>
            <a href="<?php echo $links["theme_options.modified_link"]; ?>" class="link_css"> Modified <?php echo $symbol ?></a>
            </th>
			
          <th></th>
      </thead>
      <tbody>
      <?php $count=1;
            $img_path=url('/').'/uploads/';
          foreach($data as $value){
           ?>
          <tr id="hide<?php $value->t_id; ?>" >
            
            <th>
            <input name='input' id='del' onclick="callme('show')"  type='checkbox' class='del' value='<?php echo $value->t_id; ?>'/>
            </th>
            <th>
            <?php echo $count; $count++; ?>
            </th>
            <th>
            <?php echo e($value->user_id); ?>

            </th>
                
            <th>
            <?php echo e($value->theme_id); ?>

            </th>
                
            <th>
            <?php echo e($value->site_name); ?>

            </th>
                
            <th>
            <?php echo e($value->logo_url); ?>

            </th>
                
            <th>
            <?php echo e($value->email); ?>

            </th>
                
            <th>
            <?php echo e($value->contact_no); ?>

            </th>
                
            <th>
            <?php echo e($value->address); ?>

            </th>
                
            <th>
            <?php echo e($value->background_music); ?>

            </th>
                
            <th>
            <?php echo e($value->base_url); ?>

            </th>
                
            <th>
            <?php echo e($value->domain); ?>

            </th>
                
            <th>
            <?php echo e($value->created); ?>

            </th>
                
            <th>
            <?php echo e($value->modified); ?>

            </th>
                
		   <th>
           <a href="<?php echo url("/"); ?>/admin/theme_options/view/<?php echo $value->t_id?>" title="View">
            <span class="btn btn-info " ><i class="fa fa-eye"></i></span>
           </a>
           <a href="<?php echo url("/"); ?>/admin/theme_options/edit/<?php echo $value->t_id; ?>" title="Edit">
            <span class="btn btn-info " ><i class="fa fa-edit"></i></span>
           </a>
           <a  title="Delete" data-toggle="modal" data-target="#commonDelete" onclick="$('#set_commondel_id').val('<?php echo $value->t_id; ?>');">
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
 <form action="<?php echo url('/'); ?>/admin/theme_options/delete" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="frm_title">Delete</h4>
      </div>
      <div class="modal-body" id="frm_body">
   Do you really want to delete?
    <input type="hidden" id="set_commondel_id" name="t_id">
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
         url:'<?php echo url("/")."/admin/theme_options/deleteAll"; ?>',
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