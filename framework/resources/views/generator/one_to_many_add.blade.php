<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo url('/'); ?>/accets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo url('/'); ?>/accets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo url('/'); ?>/accets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo url('/'); ?>/accets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo url('/'); ?>/accets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo url('/'); ?>/accets/build/css/custom.min.css" rel="stylesheet">

    <!-- Datepicker -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- Datetimepicker -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- Chosen -->
    <link href="<?php echo url('/'); ?>/accets/vendors/chosen/chosen.css" rel="stylesheet">
    <?php
    $contr = Request::segment(1);
    $action = Request::segment(2);
    $contrnew = $contr . '/' . $action;
    ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        

        <!-- top navigation -->
        
        <!-- /top navigation -->


      <div class = "container">

@section('content')
<div class="" role="main">
  <div class="row x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">





    <!-- Generator Start -->
        <div class="row">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox ">

            <!-- BO : content  -->
            <div class="col-sm-12 white-bg ">
                <div class="">
                    <div class="box-header with-border">
                        <h3 class="box-title">  </h3>
                    </div><!-- /.box-header -->

                    <!-- form start -->
                    <form action="<?php echo url('/') ?>/generator/one_to_many_add_post" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="box-body">

                            @if(Session::has('message'))
                                  <div class="alert alert-success">
                                      <button type="button" class="close" data-close="alert"></button>
                                       {{ Session::get('message') }}
                                  </div>
                            @endif

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
                            <div class="form-group" id="result_field">

                            </div>
                            <div class="form-group">
                                <div class="col-sm-12" id="tbl_result">

                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-3" >                       
                                </div>
                                <div class="col-sm-6">
                                    <button type="reset" class="btn btn-default ">Reset</button>
                                    <button type="submit" disabled="disabled" id="generate-btn" class="btn btn-info" style="display: none;">Generate</button>
                                </div>
                                <div class="col-sm-3" >                       
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
                data: "dropdown_tbl=" + dropdown_tbl + '&field=' + field + '&id=' + id+"&_token="+"{{ csrf_token() }}",
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
            var tbl_name = $('#table_name_new').val();
            var parent_table = parent.$("#table_name_new").val();
             // Get Related Field
            $.ajax({
                url: '<?php echo url('/') . "/generator/get_key_dropdown"; ?>',
                type: "post",
                data: "parent_table="+parent_table+"&dropdown_tbl=" + tbl_name+"&_token="+"{{ csrf_token() }}",
                beforeSend: function () {
                },
                success: function (result) {
                    $("#result_field").html(result);
                    $('[data-toggle="popover"]').popover(); 
                },
                error: function (output)
                {
                }
            });


            $.ajax({
                url: '<?php echo url('/') . "/generator/getFieldsOneToMany"; ?>',
                type: "post",
                data: "tbl_name=" + tbl_name+"&_token="+"{{ csrf_token() }}",
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
                data:"_token="+"{{ csrf_token() }}",
                beforeSend: function () {
                },
                success: function (result) {
                    $("#result_one_many_table").append(result);
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
                data:"_token="+"{{ csrf_token() }}",
                beforeSend: function () {
                },
                success: function (result) {
                    $("#result_multi_table").append(result);
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
                data: "dropdown_tbl=" + dropdown_tbl + '&field=' + field + '&id=' + id+"&_token="+"{{ csrf_token() }}",
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

        function show_relation_key_value(dropdown_id, key_id, value_id, field, id)
        {
            var table = $("#table_name_new").val();
            var dropdown_tbl = $("#" + dropdown_id).val();
            $.ajax({
                url: '<?php echo url('/') . "/generator/multi_relation_get_key_value"; ?>',
                type: "post",
                data: "table="+table+"&dropdown_tbl=" + dropdown_tbl + '&field=' + field + '&id=' + id+"&_token="+"{{ csrf_token() }}",
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
                data: "tbl_name=" + tbl_name+"&_token="+"{{ csrf_token() }}",
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
                data: "table="+table_name+"&_token="+"{{ csrf_token() }}",
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

        function submit_me()
        {
            // document.getElementById('myIframe').contentWindow.calling();
            var relations=Array()
            $('iframe').each(function(){
                rel_table = $(this).contents().find('#table_name_new').val();
                rel_field = $(this).contents().find('#related_field').val();
                $(this).contents().find('#generate-btn').click();
                relations.push({rel_field:rel_field, rel_table:rel_table});
            });
            $("#one_to_many").val(JSON.stringify(relations));
            console.log(JSON.stringify(relations));
            setTimeout(function(){ $("#current_form").submit(); },3000);
        }
        </script> 
    </div>  
    <!-- Generator End -->


    </div>
  </div>
</div>
</div>




      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo url('/'); ?>/accets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo url('/'); ?>/accets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- Select2 -->
    <script src="<?php echo url('/'); ?>/accets/vendors/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".select2").select2();
      });
    </script>
    <!-- NProgress -->
    <script src="<?php echo url('/'); ?>/accets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo url('/'); ?>/accets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo url('/'); ?>/accets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo url('/'); ?>/accets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo url('/'); ?>/accets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo url('/'); ?>/accets/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo url('/'); ?>/accets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo url('/'); ?>/accets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/chosen/chosen.jquery.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo url('/'); ?>/accets/build/js/custom.min.js"></script>
    <script type="text/javascript">
      $(".date").datepicker({
        format: 'yyyy-mm-dd'
      });
      $('.datetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
      });
      $('.timepicker').datetimepicker({
        format: 'HH:mm:ss'
      });
    </script>
    <script src="<?php echo url('/'); ?>/accets/recordDel.js"></script>
  </body>
</html>