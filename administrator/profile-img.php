<?php
session_start();
if(!isset($_SESSION['dsrrSessuser'])){
  header('Location: ../');
  exit();
}

include "../config/database.class.php";
$db = new database();
$db->connect();

require_once "controller/checkuserinfo.php";

?>
<!DOCTYPE html>
<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>Welcome to Wizn admin</title>

        <meta name="description" content="AppUI - Admin Student information Template & UI Framework" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="../assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="../assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="../assets/js/plugins/dropzonejs/dropzone.min.css" />
        <link rel="stylesheet" href="../assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.css" />

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
                                Student information
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
                      <div class="card card-profile">
                          <div class="card-profile-img" style="height: 50px; background: #43AA00;" >
                          </div>
                          <div class="card-block card-profile-block text-xs-center text-sm-left">
                            <?php
                            if(($resultRecord[0]['info_picture']!='') && ($resultRecord[0]['info_picture']!='-')) {
                              ?>
                              <img class="img-avatar img-avatar-96" src="../images/profile/<?php print $resultRecord[0]['info_picture']; ?>" alt="" />
                              <?php
                            }else{
                              ?>
                              <img class="img-avatar img-avatar-96" src="../assets/img/avatars/avatar3.jpg" alt="" />
                              <?php
                            }
                            ?>
                              <div class="profile-info font-500">
                                <span style="font-size: 1.5em;">
                                  <?php
                                  print $resultRecord[0]['info_fname']." ".$resultRecord[0]['info_lname'];
                                ?></span>

                                <div class="small text-muted m-t-xs">
                                  <a href="profile-img.php">Change profile picture</a> | <a href="changepassword.php">Change password</a>
                                </div>
                              </div>
                          </div>
                      </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                                    <div class="card-header bg-green bg-inverse">
                                        <h4>Change profile picture</h4>
                                    </div>
                                    <div class="card-block card-block-full" >
                                      <div class="row">
                                        <div class="col-xs-12">
                                          <div class="alert alert-info">
                                              <p><strong>Note!</strong> Reccommand picture size width and height 1000 x 1000 pixel .</p>
                                          </div>
                                        </div>
                                      </div>
                                        <!-- DropzoneJS Container -->
                                        <form class="dropzone" id="myFile" action="controller/upload_picture.php" ></form>
                                    </div>
                                    <!-- .card-block -->
                                    <div class="card-block" style="padding-top: 0px;">
                                        <form class="form-horizontal" action="#" method="post" >
                                          <div class="form-group m-b-0">
                                              <div class="col-xs-12">
                                                  <button class="btn btn-app" type="submit">Reload you profile image</button>
                                              </div>
                                          </div>
                                        </form>
                                    </div>
                                    <!-- .card-block -->
                                </div>
                                <!-- .card -->
                                <!-- End Bootstrap registration -->
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
        <script src="../assets/js/plugins/dropzonejs/dropzone.min.js"></script>
    </body>
    <script type="text/javascript">
    $(function(){
      // jQuery
      // $("div#myFile").dropzone({ url: "controller/upload_picture.php" });
      // var myDropzone = new Dropzone("#a1", { url: "controller/upload_picture.php"});

      $("#myFile").on("complete", function(file) {
        myDropzone.removeFile(file);
      });
    });
    </script>
</html>
