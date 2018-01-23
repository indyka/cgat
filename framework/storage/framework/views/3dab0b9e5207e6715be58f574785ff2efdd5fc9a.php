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
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>
                <script type="text/javascript">
                  var message = "LARA GENERATOR"
            var neonbasecolor = "gray"
            var neontextcolor = "white"
            var flashspeed = 150  //in milliseconds
            ///No need to edit below this line/////
            var n = 0
            if (document.all || document.getElementById) {
                document.write('<font color="' + neonbasecolor + '">')
                for (m = 0; m < message.length; m++)
                    document.write('<span id="neonlight' + m + '">' + message.charAt(m) + '</span>')
                document.write('</font>')
            } else
                document.write(message)
            function crossrefaa(number) {
                var crossobj = document.all ? eval("document.all.neonlight" + number) : document.getElementById("neonlight" + number)
                return crossobj
            }
            function neonaa() {
                //Change all letters to base color
                if (n == 0) {
                    for (m = 0; m < message.length; m++)
                        //eval("document.all.neonlight"+m).style.color=neonbasecolor
                        crossrefaa(m).style.color = neonbasecolor
                }
                //cycle through and change individual letters to neon color
                crossrefaa(n).style.color = neontextcolor
                if (n < message.length - 1)
                    n++
                else {
                    n = 0
                    clearInterval(flashing)
                    setTimeout("beginneonaa();", 1500)
                    return
                }
            }
            function beginneonaa() {
                if (document.all || document.getElementById)
                    flashing = setInterval("neonaa();", flashspeed)
            }
            beginneonaa();
        
                </script>
              </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo url('/'); ?>/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                  <li <?php if($action == 'dashboard'){?>class="active "<?php } ?>>
                    <a href="<?php echo url("/")."/admin/dashboard";?>"><i class="fa fa-home"></i> Dashboard </a>
                  </li>

                  <li <?php if($action == 'generator'){?>class="active "<?php } ?>>
                    <a href="<?php echo url("/")."/admin/generator";?>"><i class="fa fa-home"></i> Generator </a>
                  </li>

               
               <!--  @@@@@#####@@@@@ -->

                

                <!-- BO : Users -->
                  <?php if (\Entrust::can('role-create')) : ?>
                  <li <?php if($action == 'users'){?>class="active "<?php } ?>  >
                      <a href="<?php echo e(route('users.index')); ?>"><i class="fa fa-users"></i>
                      Users
                      </a>
                  </li>
                  <?php endif; // Entrust::can ?>
                  <!--  EO : Users -->

                  <!-- BO : Roles -->
                  <?php if (\Entrust::can('role-create')) : ?>
                  <li <?php if($action == 'roles'){?>class="active "<?php } ?>  >
                      <a href="<?php echo e(route('roles.index')); ?>"><i class="fa fa-users"></i>
                      Roles
                      </a>
                  </li>
                  <?php endif; // Entrust::can ?>
                <!--  EO : Roles -->

              </ul>
            </div>
          </div>
        <!-- /sidebar menu -->



            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo url('/'); ?>/images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->


      <div class = "container">
        <?php echo $__env->yieldContent('content'); ?>
      </div>




        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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