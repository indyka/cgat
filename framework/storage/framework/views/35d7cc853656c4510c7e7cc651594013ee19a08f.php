<?php $__env->startSection('content'); ?>
<div class="right_col" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
        




    <!-- Generator Start -->
        <div class="row">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox ">
            <div class="ibox-title" >
                <h5>Add <small></small></h5>
                <div class="ibox-tools">                           
                </div>
            </div>
            <!-- BO : content  -->
            <div class="col-sm-12 white-bg ">
                <div class="">
                    <div class="box-header with-border">
                        <h3 class="box-title">  </h3>
                    </div><!-- /.box-header -->

                    <!-- form start -->
                    <form action="<?php echo url('/') ?>/generator/add" id="current_form" class="form-horizontal " method="post" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                        <div class="box-body">

                            <?php if(Session::has('message')): ?>
                                  <div class="alert alert-success">
                                      <button type="button" class="close" data-close="alert"></button>
                                       <?php echo e(Session::get('message')); ?>

                                  </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="Module_name" class="col-sm-3 control-label"> Tables </label>
                                <div class="col-sm-4">
                                    <select onchange="getField();" class="form-control" id="table_name_new" name="table_name">
                                        <option value="">-Select Table-</option>
                                        <?php
                                        for ($i = 0; $i < count($Tables); $i++) {
                                            if(!in_array($Tables[$i], array('ci_sessions', 'users'))){
                                            ?>
                                            <option value="<?php echo $Tables[$i]; ?>"><?php echo $Tables[$i] ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-12" id="tbl_result">

                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-3" >                       
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" disabled="disabled" id="generate-btn" class="btn btn-info" onclick="submit_me();">Generate</button>
                                </div>
                                <div class="col-sm-3" >                       
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->
                <br><br><br><br>
            </div>
            <!-- EO : content  -->
        </div>
    </div>

    <script type="text/javascript">
        function checkAllCheckbox()
        {
            $(".checked").each(function () {
                if ($("#checkAll").prop("checked") == true)
                {
                    if ($(this).prop("checked") == false)
                    {
                        $(this).click();
                    }
                    $("#generate-btn").removeAttr("disabled");
                } else
                {
                    $(this).click();
                    $("#generate-btn").attr("disabled", "disabled");
                }
            });
        }

        function setTitleRadio(field)
        {
            $("#selected_field_radio").val(field);
        }

        function setTitleCheck(field)
        {
            $("#selected_field_check").val(field);
        }

        function setTitle(field, from)
        {
            $("#selected_field").val(field);
        }

        function close_all()
        {
            var selected_radio = $("#selected_radio").val();
            $("#" + selected_radio).hide();
        }

        function add_more_radio(id)
        {
            var rad_id = $("#radio_id").val();
            var selected_radio = $("#selected_radio").val();
            var accet_url = $("#accet_url").val();
            var selected_field = $("#selected_field_radio").val();
            var x = document.getElementById(selected_radio).rows.length;
            x = x + 1;
            $("#" + id).append('<tr id="radio_row_' + x + '"><td><input value="Radio" type="text" name="' + selected_field + '[radios][]"></td><td><img src="' + accet_url + '/img/button-cross_basic_red.png" width="25px" onclick="del_ratio_row(\'radio_row_' + x + '\');"></td></tr>');
        }

        function del_ratio_row(id)
        {
            $("#" + id).remove();
        }

        function select_radio(id, num)
        {
            $("#"+id).closest("tr").find(".top-display").css("display", "none");
            $("#" + id).show();
            $("#selected_radio").val(id);
            $("#radio_id").val(num);
        }
        // checkbox js start

        function close_all_select()
        {
            var selected_check = $("#selected_check").val();
            $("#" + selected_check).hide();
        }

        function add_more_check(id)
        {
            var chk_id = $("#check_id").val();
            var selected_check = $("#selected_check").val();
            var accet_url = $("#accet_url").val();
            var selected_field = $("#selected_field_check").val();
            var x = document.getElementById(selected_check).rows.length;
            x = x + 1;
            $("#" + id).append('<tr id="check_row_' + x + '"><td><input value="Checkbox" type="text" name="' + selected_field + '[checks][]"></td><td><img src="' + accet_url + '/img/button-cross_basic_red.png" width="25px" onclick="del_check_row(\'check_row_' + x + '\');"></td></tr>');
        }

        function del_check_row(id)
        {
            $("#" + id).remove();
        }

        function select_check(id, num)
        {
            $("#"+id).closest("tr").find(".top-display").css("display", "none");
            $("#" + id).show();
            $("#selected_check").val(id);
            $("#check_id").val(num);
        }
        // checkbox js end

        function show_tables(id)
        {
            $("#"+id).closest("tr").find(".top-display").css("display", "none");
            table_name_new = $("#table_name_new").val();
            $("#"+id+" select option:contains('"+table_name_new+"')").attr("disabled","disabled");

            $("#" + id).show();
            $("#"+id+" select:first").change();
        }

        function show_key_value(dropdown_id, key_id, value_id, field, id)
        {
            var dropdown_tbl = $("#" + dropdown_id).val();
            $.ajax({
                url: '<?php echo url('/')."/generator/getKeyValue"; ?>',
                type: "post",
                data: "dropdown_tbl=" + dropdown_tbl + '&field=' + field + '&id=' + id+"&_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    var arr = result.split("==##==");
                    $('#' + key_id).css('display', 'block');
                    $('#' + value_id).css('display', 'block');

                    $("#" + key_id).html(arr[0]);
                    $("#" + value_id).html(arr[1]);
                },
                error: function (output)
                {
                }
            });
        }




        function getField()
        {
            var parent_table = $("#table_name_new").val();
            var tbl_name = $('#table_name_new').val();
            $.ajax({
                url: '<?php echo url('/') . "/generator/getFields"; ?>',
                type: "post",
                data: "parent_table="+parent_table+"&tbl_name=" + tbl_name+"&_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    $("#tbl_result").html(result);
                    $(".chosen-select").chosen();
                    // Input checked after select
                    $("input.checked").on('click', function () {
                        if($("input.checked:checked").length>0){
                            $("#generate-btn").removeAttr("disabled");
                        } else{
                            $("#generate-btn").attr("disabled", "disabled");
                        }
                        if ($(this).prop("checked")) {
                            var temp = $(this).parent().parent();
                            temp.css("background-color", "#FFFFCC");
                            var temp1 = temp.find('.default_input');
                            temp1.click();
                        } else
                        {
                            var temp = $(this).parent().parent();
                            temp.css("background-color", "#fff");
                            var temp1 = temp.find('input[type=radio],input[type=checkbox]');
                            temp1.removeAttr("checked");
                        }
                    });
                    // ./ Input checked after select /.

                    // On radio check select checkbox
                    $("input[type=radio]").click(function () {
                        var check = $(this).parent().parent().find("input[type=checkbox]");
                        check.prop("checked", true);
                        var temp = $(this).parent().parent();
                        temp.css("background-color", "#FFFFCC");

                        if($("input.checked:checked").length>0){
                            $("#generate-btn").removeAttr("disabled");
                        } else{
                            $("#generate-btn").attr("disabled", "disabled");
                        }
                    });
                    // ./ On radio check select checkbox /.
                },
                error: function (output)
                {
                }
            });
        }




        // New functions start here

        function get_table_dropdown()
        {
            $.ajax({
                url: '<?php echo url('/') . "/generator/get_table_dropdown"; ?>',
                type: "post",
                data:"_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    $("#result_one_many_table").append(result);
                    $('[data-toggle="popover"]').popover(); 
                },
                error: function (output)
                {
                }
            });
        }

        function add_multi_table(multi_table_id, relation_table_id)
        {
            $.ajax({
                url: '<?php echo url('/') . "/generator/get_multi_table_html"; ?>',
                type: "post",
                data:"_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    $("#result_multi_table").append(result);
                    $('[data-toggle="popover"]').popover(); 
                },
                error: function (output)
                {
                }
            });
        }

        function multi_select_show_key_value(dropdown_id, key_id, value_id, field, id)
        {
            var dropdown_tbl = $("#" + dropdown_id).val();
            $.ajax({
                url: '<?php echo url('/') . "/generator/multi_select_get_key_value"; ?>',
                type: "post",
                data: "dropdown_tbl=" + dropdown_tbl + '&field=' + field + '&id=' + id+"&_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    var arr = result.split("==##==");
                    $('#' + key_id).css('display', 'block');
                    $('#' + value_id).css('display', 'block');

                    $("#" + key_id).html(arr[0]);
                    $("#" + value_id).html(arr[1]);

                    $('[data-toggle="popover"]').popover(); 
                },
                error: function (output)
                {
                }
            });
        }

        function show_relation_key_value(dropdown_id, key_id, value_id, field, id)
        {
            var table = $("#table_name_new").val();
            var dropdown_tbl = $("#" + dropdown_id).val();
            $.ajax({
                url: '<?php echo url('/') . "/generator/multi_relation_get_key_value"; ?>',
                type: "post",
                data: "table="+table+"&dropdown_tbl=" + dropdown_tbl + '&field=' + field + '&id=' + id+"&_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    var arr = result.split("==##==");
                    $('#' + key_id).css('display', 'block');
                    $('#' + value_id).css('display', 'block');

                    $("#" + key_id).html(arr[0]);
                    $("#" + value_id).html(arr[1]);
                },
                error: function (output)
                {
                }
            });
        }


        function getFieldOneToMany()
        {
            var tbl_name = $('#one_many_table_name').val();
            $.ajax({
                url: '<?php echo url('/') . "/generator/get_one_many_fields"; ?>',
                type: "post",
                data: "tbl_name=" + tbl_name+"&_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    $("#one_many_tbl_result").html(result);
                    try{
                        $(".chosen-select").chosen();
                    } catch(e){

                    }

                    // Input checked after select
                    $("input.checked").on('click', function () {
                        if($("input.checked:checked").length>0){
                            $("#generate-btn").removeAttr("disabled");
                        } else{
                            $("#generate-btn").attr("disabled", "disabled");
                        }
                        if ($(this).prop("checked")) {
                            var temp = $(this).parent().parent();
                            temp.css("background-color", "#FFFFCC");
                            var temp1 = temp.find('.default_input');
                            temp1.click();
                        } else
                        {
                            var temp = $(this).parent().parent();
                            temp.css("background-color", "#fff");
                            var temp1 = temp.find('input[type=radio],input[type=checkbox]');
                            temp1.removeAttr("checked");
                        }
                    });
                    // ./ Input checked after select /.

                    // On radio check select checkbox
                    $("input[type=radio]").click(function () {
                        var check = $(this).parent().parent().find("input[type=checkbox]");
                        check.prop("checked", true);
                        var temp = $(this).parent().parent();
                        temp.css("background-color", "#FFFFCC");

                        if($("input.checked:checked").length>0){
                            $("#generate-btn").removeAttr("disabled");
                        } else{
                            $("#generate-btn").attr("disabled", "disabled");
                        }
                    });
                    // ./ On radio check select checkbox /.

                    // Popover / i
                    $('[data-toggle="popover"]').popover(); 
                },
                error: function (output)
                {
                }
            });
        }

         function popuplate_multi_get_key_value(element, key, value, type='') {
          var table_name = $(element).val();
          var multi_table = $('.multi_table').val();
          var parent_table = $("#table_name_new").val();
            url_new= '<?php echo url('/') . "/generator/popuplate_multi_get_key_value"; ?>';

          console.log(url_new);
          $.ajax({
                url: url_new,
                type: "post",
                data: "parent_table="+parent_table+"&multi_table="+multi_table+"&table="+table_name+"&_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    var arr = result.split("==##==");
                    $(element).closest("table").find("."+key).html(arr[0]);
                    $(element).closest("table").find("."+value).html(arr[1]);
                    // Popover / i
                    $('[data-toggle="popover"]').popover(); 
                },
                error: function (output)
                {
                }
            });
        }


        function populate_key_val(element, key, value, type='') {
          var table_name = $(element).val();

          console.log(type);
          if (type=="") {
            url_new= '<?php echo url('/') . "/generator/multi_get_key_value"; ?>';
          }
          else
          {
            url_new= '<?php echo url('/') . "/generator/r_get_key_value"; ?>';
          }
          console.log(url_new);
          $.ajax({
                url: url_new,
                type: "post",
                data: "table="+table_name+"&_token="+"<?php echo e(csrf_token()); ?>",
                beforeSend: function () {
                },
                success: function (result) {
                    var arr = result.split("==##==");
                    $(element).closest("table").find("."+key).html(arr[0]);
                    $(element).closest("table").find("."+value).html(arr[1]);
                },
                error: function (output)
                {
                }
            });
        }

        function delete_multi_table(element)
        {
            $(element).closest("table").remove();
        }

        function delete_one_to_many(element)
        {
            $(element).closest("div").remove();   
        }

        function submit_me()
        {
            var relations=Array()
            $('iframe').each(function(){
                rel_table = $(this).contents().find('#table_name_new').val();
                rel_field = $(this).contents().find('#related_field').val();
                $(this).contents().find('#generate-btn').click();
                relations.push({rel_field:rel_field, rel_table:rel_table});
            });
            $("#one_to_many").val(JSON.stringify(relations));
            setTimeout(function(){ $("#current_form").submit(); },1000);
        }
        </script>
    </div>
    <!-- Generator End -->


    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>