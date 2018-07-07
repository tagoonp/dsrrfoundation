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
                                Administrator panal
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
                              <a href="add_page.php" class="btn btn-app-teal"><i class="fa fa-plus"></i> Add new</a>
                            </p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header bg-blue bg-inverse">
                                <h4>Posts</h4>
                              </div>
                              <div class="card-block">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" style="font-size: 0.85em;">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Title</th>
                                            <!-- <th class="hidden-xs">Full name</th> -->
                                            <th class="col-sm-2">Date</th>
                                            <th class="hidden-xs">Author</th>
                                            <th class="hidden-xs">Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $strSQL = sprintf("SELECT * FROM tsd_content a inner join tsd_contentgroup b on a.ctg_id = b.ctg_id WHERE a.ctg_id = '99' ORDER BY a.cont_adddate DESC ");
                                      $resultPost = $db->select($strSQL,false,true);

                                      if($resultPost){
                                        $c = 1;
                                        foreach ($resultPost as $value) {
                                          ?>
                                          <tr>
                                              <td class="text-center"><?php print $c; ?></td>
                                              <td>
                                                <a href="update_page.php?id=<?php print $value['cont_id'];?>"><?php print $value['cont_title'];?></a>
                                              </td>

                                              <td>
                                                <?php
                                                    print $value['cont_adddate'];
                                                  ?>
                                              </td>
                                              <td class="hidden-xs">
                                                <?php
                                                    print $value['username'];
                                                ?>
                                              </td>
                                              <td class="hidden-xs">
                                                <?php
                                                    print $value['ctg_title'];
                                                ?>
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
        <script src="js/administrator.js"></script>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/base_tables_datatables.js"></script>

    </body>

</html>
