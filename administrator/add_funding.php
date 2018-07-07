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

$error = 0;
if(isset($_GET['error'])){
  $error = $_GET['error'];
}

$resultFundedit = false;
if(isset($_GET['pre_id'])){
    $strSQL = sprintf("SELECT * FROM tb_funding WHERE fund_id = '%s'", mysql_real_escape_string($_GET['fund_id']));
    $resultFundedit = $db->select($strSQL,false,true);
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
                                Education staff panal :: Configuration funding
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
                            <p>
                              <a href="funding.php" class="btn btn-app-orange"><i class="fa fa-th-list"></i> Funding list</a>
                            </p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header bg-red bg-inverse">
                                <h4><i class="fa fa-plus"></i> Add new funding source</h4>
                              </div>
                              <div class="card-block">
                                <form class="js-validation-bootstrap_prefix form-horizontal" action="controller/prefix.php" method="post" >
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <?php
                                      if($error==1){
                                        ?>
                                        <div class="alert alert-danger">
                                            <p><strong>Warning!</strong> duplicate prefix.</p>
                                        </div>
                                        <?php
                                      }else if($error==2){
                                        ?>
                                        <div class="alert alert-danger">
                                            <p><strong>Warning!</strong> add new prefix fail.</p>
                                        </div>
                                        <?php
                                      }else{
                                        ?>
                                        <div class="alert alert-danger">
                                            <p><strong>Required!</strong> please enter all required (**) field.</p>
                                        </div>
                                        <?php
                                      }
                                      ?>

                                    </div>
                                  </div>
                                    <?php
                                    if($resultFundedit){
                                      ?>
                                      <div class="form-group">
                                          <label class="col-xs-12" for="old-password">Prefix id <span class="text-red">**</span></label>
                                          <div class="col-xs-12">
                                              <input class="form-control" type="text" id="txtPrefixid" name="txtPrefixid"  value="<?php if($resultFundedit){ print $resultFundedit[0]['pre_id']; }?>" readonly="" />
                                          </div>
                                      </div>
                                      <?php
                                    }
                                    ?>

                                    <div class="form-group">
                                        <label class="col-xs-12" for="old-password">Short name <span class="text-red">**</span></label>
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="txtPrefix" name="txtPrefix" placeholder="Enter funding short name..." value="<?php if($resultFundedit){ print $resultFundedit[0]['prefix']; }?>" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12" for="old-password">Full name <span class="text-red">**</span></label>
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="txtPrefix" name="txtPrefix" placeholder="Enter full name..." value="<?php if($resultFundedit){ print $resultFundedit[0]['prefix']; }?>" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12" for="old-password">Description <span class="text-red">**</span></label>
                                        <div class="col-xs-12">
                                            <textarea class="form-control" id="example-textarea-input" name="example-textarea-input" rows="6" placeholder="Description.."></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-b-0">
                                        <div class="col-xs-12">
                                            <button class="btn btn-app" type="submit">Save</button>
                                            <button class="btn btn-app-light" type="reset">Reset</button>
                                        </div>
                                    </div>
                                </form>
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
        <script src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/base_tables_datatables.js"></script>
        <script src="js/base_forms_validation.js"></script>
        <script src="js/education.js"></script>
    </body>

</html>
