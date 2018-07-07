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

        <script src="../library/ckeditor/ckeditor.js"></script>
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
                            <a href="post.php" class="btn btn-app-teal"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;Post</a>
                            <a href="category.php" class="btn btn-app-orange">Category</a>
                          </p>
                        </div>
                      </div>
                      <form class="js-validation-bootstrap_post form-horizontal" action="controller/insert_post.php" method="post" >
                        <div class="row">
                          <div class="col-md-9">
                            <div class="card">
                              <div class="card-header bg-blue bg-inverse">
                                <h4><i class="fa fa-plus"></i> Add New Post</h4>
                              </div>
                              <div class="card-block">

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

                                    <div class="form-group">
                                        <label class="col-xs-12" for="old-password">Title <span class="text-red">**</span></label>
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="txtTitle" name="txtTitle" placeholder="Enter post title here" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12" for="old-password">Content type </label>
                                        <div class="col-xs-12">
                                            <select class="form-control" name="txtContentType" id="txtContentType">
                                              <option value="1" selected="">Content</option>
                                              <option value="2" >File redirection</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="fileDiv" style="display:none;">
                                      <div class="form-group">
                                          <label class="col-xs-12" for="old-password">File url </label>
                                          <div class="col-xs-12">
                                              <input class="form-control" type="text" id="txtFileUrl" name="txtFileUrl" placeholder="Enter file url here" value="" />
                                          </div>
                                      </div>
                                    </div>

                                    <div id="contentDiv" >
                                      <div class="form-group">
                                          <label class="col-xs-12" for="old-password">Content </label>
                                          <div class="col-xs-12">
                                            <textarea name="editor1" id="editor1" rows="10" cols="80">
                                                This is my textarea to be replaced with CKEditor.
                                            </textarea>
                                            <script>
                                                CKEDITOR.replace( 'editor1' );
                                            </script>
                                          </div>
                                      </div>
                                    </div>

                              </div>
                            </div>
                          </div>

                          <!-- End col-md-9 -->

                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-header bg-blue bg-inverse">
                                <h4>Publish</h4>
                              </div>
                              <div class="card-block">
                                <div class="form-group">
                                    <label class="col-xs-12" for="old-password">Categories <span class="text-red">**</span></label>
                                    <div class="col-xs-12">
                                      <select class="form-control" name="txtCategory" id="txtCategory">
                                        <option value="" selected="">--- Select category ---</option>
                                        <?php
                                        $strSQL = sprintf("SELECT * FROM tsd_contentgroup WHERE ctg_id != '99'");
                                        $resultCategory = $db->select($strSQL,false,true);

                                        if($resultCategory){
                                          foreach ($resultCategory as $value) {
                                            ?>
                                            <option value="<?php print $value['ctg_id']?>"><?php print $value['ctg_title']; ?></option>
                                            <?php
                                          }
                                        }
                                        ?>
                                      </select>

                                      <!-- <input class="form-control" type="text" id="txtPrefix" name="txtPrefix" placeholder="Enter post title here" value="<?php if($resultFundedit){ print $resultFundedit[0]['prefix']; }?>" /> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12" for="old-password">Event date </label>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="date" id="txtEventdate" name="txtEventdate" placeholder="Enter file url here" value="" />
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="col-xs-12">
                                        <button class="btn btn-app-blue" type="submit">Publish</button>
                                        <button class="btn btn-app-light" type="reset">Reset</button>
                                    </div>
                                </div>
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-header bg-cyan bg-inverse">
                                <h4>Featured image</h4>
                              </div>
                              <div class="card-block">
                                <div class="form-group">
                                    <label class="col-xs-12" for="old-password">Index image url </label>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" id="txtIndexcover" name="txtIndexcover" placeholder="Enter image url" value="<?php if($resultFundedit){ print $resultFundedit[0]['prefix']; }?>" />
                                        <p style="font-size: 0.7em; color: red; padding: 5px 0px 0px 3px;">
                                          Recommand size for article or book, 200 pixel width x 300 pixel height.
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12" for="old-password">Content image url </label>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" id="txtCover" name="txtCover" placeholder="Enter image url" value="<?php if($resultFundedit){ print $resultFundedit[0]['prefix']; }?>" />
                                    </div>
                                </div>
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-header bg-cyan bg-inverse">
                                <h4>Tags</h4>
                              </div>
                              <div class="card-block">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" id="txtTag" name="txtTag" placeholder="Enter keyword here..." value="<?php if($resultFundedit){ print $resultFundedit[0]['prefix']; }?>" />
                                        <p style="font-size: 0.7em; color: red; padding: 5px 0px 0px 3px;">
                                          Each tags plit by comma (,)
                                        </p>
                                    </div>
                                </div>
                              </div>
                            </div>

                          </div>
                          <!-- End col-md-3 -->
                        </div>
                        <!-- .row -->
                      </form>
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
        <script src="js/administrator.js"></script>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/base_tables_datatables.js"></script>
        <script src="js/base_forms_validation.js"></script>
        <script src="js/education.js"></script>
    </body>

</html>
