<?php
session_start();
if(!isset($_SESSION['sisSessuser'])){
  header('Location: ../');
  exit();
}

include "../database/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM tb_user a inner join tb_user_desc b on a.username = b.username WHERE a.username = '%s' ", mysql_real_escape_string($_SESSION['sisSessuser']));
$resultRecord = $db->select($strSQL,false,true);

if(!$resultRecord){
  $db->disconnect();
  header('Location: 404-error.html');
  exit();
}
?>
<!DOCTYPE html>
<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title><?php
          print $resultRecord[0]['user_prefix']." ".$resultRecord[0]['user_fname']." ".$resultRecord[0]['user_lname'];
        ?></title>

        <meta name="description" content="AppUI - Admin Student information Template & UI Framework" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="../assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="../assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="../assets/js/plugins/datatables/jquery.dataTables.min.css" />


        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="../assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="../assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="../assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="../assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="../assets/css/app-custom.css" />
        <!-- End Stylesheets -->
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <!-- Drawer -->
                <aside class="app-layout-drawer">

                    <!-- Drawer scroll area -->
                    <?php include "componants/menu.php"; ?>
                    <!-- End drawer scroll area -->
                </aside>
                <!-- End drawer -->

                <!-- Header -->
                <header class="app-layout-header">
                  <nav class="navbar navbar-default">
                      <div class="container-fluid">
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                              <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
                                <span class="sr-only">Toggle drawer</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                              <span class="navbar-page-title">
                                Education staff panal :: Monitor
                              </span>
                          </div>
                          <?php include "componants/navbar.php"; ?>
                      </div>
                      <!-- .container-fluid -->
                  </nav>
                  <!-- .navbar-default -->
                </header>
                <!-- End header -->

                <main class="app-layout-content" style="background: #f3f3f3;">

                    <!-- Page Content -->
                    <div class="container-fluid p-y-md">

                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header bg-blue bg-inverse">
                                <h4>Monitoring list</h4>
                              </div>
                              <div class="card-block">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" style="font-size: 0.85em;">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Student ID</th>
                                            <!-- <th class="hidden-xs">Full name</th> -->
                                            <th class="hidden-xs">Advisor</th>
                                            <th class="hidden-xs">Progress</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $strSQL = sprintf("SELECT * FROM tb_student a inner join tb_user b on a.username = b.username inner join tb_monitor c on a.username = c.std_id inner join tb_prefix d on a.std_prefix = d.pre_id WHERE 1 and c.mon_status = '1' ORDER BY a.std_id DESC ");
                                      $resultMonitor = $db->select($strSQL,false,true);

                                      if($resultMonitor){
                                        $c = 1;
                                        foreach ($resultMonitor as $value) {
                                          ?>
                                          <tr>
                                              <td class="text-center"><?php print $c; ?></td>
                                              <td>
                                                <a href="student-info.php?std_id=<?php print $value['std_id'];?>" data-toggle="popover" data-placement="top" title="ID :: <?php print $value['std_id'];?>" data-content="<?php
            												if(($value['std_prefix']!='') && ($value['std_prefix']!='-') && ($value['std_prefix']!='0')){
            																					print $value['prefix']." ";
            												}

            												print $value['std_name']." ".$value['std_surname'];

                                    if($value['std_grad_year']!=''){
                                                      print "&nbsp;&nbsp;<font color=\"red\">[Graduated]</font>";
                                    }
            												?>"><?php print $value['std_id'];?></a>
                                              </td>

                                              <td class="hidden-xs">
                                                <?php
                                                    $strSQL = "SELECT * FROM tb_advice WHERE std_id = '".$value['std_id']."'";
                                                    $resultAdvice = $db->select($strSQL,false,true);
                                                    if($resultAdvice){
                                                      $strSQL = "SELECT * FROM tb_advice a inner join tb_advisor b on a.adc_main = b.adv_id or a.adc_co1 = b.adv_id or a.adc_co2 = b.adv_id WHERE a.std_id = '".$value['std_id']."'";
                                                      $resultAdv = $db->select($strSQL,false,true);
                                                      if($resultAdv){
                                                        foreach($resultAdv as $val){
                                                          print "<a href='set_advisor.php?std_id=".$value['std_id']."' data-toggle=\"tooltip\" data-placement=\"top\" title='".$val['adv_prefix'].$val['adv_name']." ".$val['adv_surname']."'>[".substr($val['adv_name'],0,1).substr($val['adv_surname'],0,1)."]</a> ";
                                                        }
                                                      }
                                                    }else{
                                                      ?>
                                                      <!-- <a href="Javascript: redirectpage('set_advisor.php?std_id=<?php //print $value['std_id']; ?>')"><span class="label label-success" title="Click to setting">Set</span></a> -->
                                                      <button class="btn btn-sm btn-success" type="button" style="font-size: 1.1em;"><i class="ion-person-add"></i></button>
                                                      <?php
                                                    }
                                                  ?>
                                              </td>
                                              <td class="hidden-xs">
                                                <?php
                                                  $strSQL = "SELECT * FROM tb_progress1 WHERE std_id = '".$value['std_id']."'";
                                                  $resultProgress1 = $db->select($strSQL,false,true);
                                                  if($resultProgress1){
                                                    if($resultProgress1[0]['pg_result']==1){
                                                      ?>
                                                      <button class="btn btn-info btn-xs" type="button">P/E</button>
                                                      <?php
                                                    // If monitor and not pass
                                                    }else{
                                                      ?>
                                                      <button class="btn btn-danger btn-xs" type="button">P/E</button>
                                                      <?php
                                                    }
                                                  }else{
                                                    ?>
                                                    <button class="btn btn-app-light btn-xs" type="button" >P/E</button>
                                                    <?php
                                                  }


                                                  if($value['std_degree']==1){
                                                    ?>
                                                    <button class="btn btn-warning btn-xs disabled" type="button">Q/E</button>
                                                    <?php
                                                  }else{
                                                    $strSQL = "SELECT * FROM tb_progress2 WHERE std_id = '".$value['std_id']."'";
                                                    $resultProgress1 = $db->select($strSQL,false,true);

                                                    if($resultProgress1){
                                                      if($resultProgress1[0]['pg_result']==1){
                                                        ?>
                                                        <button class="btn btn-info btn-xs" type="button">Q/E</button>
                                                        <?php
                                                      // If monitor and not pass
                                                      }else{
                                                        ?>
                                                        <button class="btn btn-danger btn-xs" type="button">Q/E</button>
                                                        <?php
                                                      }
                                                    }else{
                                                      ?>
                                                      <button class="btn btn-app-light btn-xs" type="button">Q/E</button>
                                                      <?php
                                                    }
                                                  }

                                                  $strSQL = "SELECT * FROM tb_progress3 WHERE std_id = '".$value['std_id']."'";
                                                  $resultProgress1 = $db->select($strSQL,false,true);
                                                  if($resultProgress1){
                                                    ?>
                                                    <button class="btn btn-info btn-xs" type="button">E.C.</button>
                                                    <?php
                                                  }else{
                                                    ?>
                                                    <button class="btn btn-app-light btn-xs" type="button">E.C.</button>
                                                    <?php
                                                  }

                                                  $strSQL = "SELECT * FROM tb_progress5 WHERE std_id = '".$value['std_id']."'";
                                                  $resultProgress1 = $db->select($strSQL,false,true);
                                                  if($resultProgress1){
                                                    if($resultProgress1[0]['pg_result']==1){
                                                      ?>
                                                      <button class="btn btn-info btn-xs" type="button">Pub</button>
                                                      <?php
                                                    // If monitor and not pass
                                                    }else{
                                                      ?>
                                                      <button class="btn btn-danger btn-xs" type="button">Pub</button>
                                                      <?php
                                                    }
                                                  }else{
                                                    ?>
                                                    <button class="btn btn-app-light btn-xs" type="button">Pub</button>
                                                    <?php
                                                  }

                                                  // print "<br>";
                                                  // End publication

                                                  $strSQL = "SELECT * FROM tb_progress7 WHERE std_id = '".$value['std_id']."'";
                                                  if($resultProgress1){
                                                    if($resultProgress1[0]['pg_result']==1){
                                                      ?>
                                                      <button class="btn btn-info btn-xs" type="button">T/E</button>
                                                      <?php
                                                    // If monitor and not pass
                                                    }else{
                                                      ?>
                                                      <button class="btn btn-danger btn-xs" type="button">T/E</button>
                                                      <?php
                                                    }
                                                  }else{
                                                    ?>
                                                    <button class="btn btn-app-light btn-xs" type="button">T/E</button>
                                                    <?php
                                                  }

                                                  // End thesis exam

                                                  // Complehensive
                                                  $strSQL = "SELECT * FROM tb_progress8 WHERE std_id = '".$value['std_id']."'";
                                                  $resultProgress1 = $db->select($strSQL,false,true);
                                                  if($resultProgress1){
                                                    if($resultProgress1[0]['pg_result']==1){
                                                      ?>
                                                      <button class="btn btn-info btn-xs" type="button">Com</button>
                                                      <?php
                                                    // If monitor and not pass
                                                    }else{
                                                      ?>
                                                      <button class="btn btn-danger btn-xs" type="button">Com</button>
                                                      <?php
                                                    }
                                                  }else{
                                                    ?>
                                                    <button class="btn btn-app-light btn-xs" type="button">Com</button>
                                                    <?php
                                                  }

                                                  // End complehensive
                                                  // English progress

                                                  $strSQL = "SELECT * FROM tb_progress9 WHERE std_id = '".$value['std_id']."'";
                                                  $resultProgress1 = $db->select($strSQL,false,true);
                                                  if($resultProgress1){
                                                    if($resultProgress1[0]['pg_result']==1){
                                                      ?>
                                                      <button class="btn btn-info btn-xs" type="button">Eng</button>
                                                      <?php
                                                    // If monitor and not pass
                                                    }else{
                                                      ?>
                                                      <button class="btn btn-danger btn-xs" type="button">Eng</button>
                                                      <?php
                                                    }
                                                  }else{
                                                    ?>
                                                    <button class="btn btn-app-light btn-xs" type="button">Eng</button>
                                                    <?php
                                                  }

                                                  // End English

                                                  ?>
                                              </td>
                                              <td class="text-center">
                                                  <div class="btn-group">
                                                      <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="View data"><i class="ion-search"></i></button>
                                                      <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Unset monitoring"><i class="ion-close"></i></button>
                                                  </div>
                                              </td>
                                          </tr>
                                          <?php
                                          $c++;
                                        }
                                      }
                                      ?>


                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>



                        </div>
                        <!-- .row -->
                    </div>
                    <!-- End Page Content -->

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <!-- Apps Modal -->
        <!-- Opens from the button in the header -->
        <div id="apps-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-sm modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <!-- Apps card -->
                    <div class="card m-b-0">
                        <div class="card-header bg-app bg-inverse">
                            <h4>Apps</h4>
                            <ul class="card-actions">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <div class="row text-center">
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-secondary bg-inverse" href="./">
                                        <i class="ion-speedometer fa-4x"></i>
                                        <p>Admin</p>
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-tertiary bg-inverse" href="frontend_home.html">
                                        <i class="ion-laptop fa-4x"></i>
                                        <p>Frontend</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- .card-block -->
                    </div>
                    <!-- End Apps card -->
                </div>
            </div>
        </div>
        <!-- End Apps Modal -->

        <div class="app-ui-mask-modal"></div>

        <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
        <script src="../assets/js/core/jquery.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="../assets/js/core/jquery.placeholder.min.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../assets/js/app-custom.js"></script>
        <!-- <script src="js/dashboard.js"></script> -->

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/base_tables_datatables.js"></script>

    </body>

</html>
