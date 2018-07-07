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

    <style media="screen">
    #overlay {
      background:#000;
      top: 0px;
      left: 0px;
      right: 0px;
      bottom: 0px;
      z-index:9999998;
      position:fixed;
      opacity: .5;
      filter: alpha(opacity=50);
      -moz-opacity: .5;
      display:none;
    }

    .info_show{
      position: fixed;
      z-index:9999999;
      margin:auto;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 88%;
      /*height: 85%;*/
      border-radius: 5px;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border: 0px solid #000000;
      background-color:#F9FAFC;
      text-align:left;
      display:none;
      padding-bottom: 30px;
    }
    </style>
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
                        <form class="js-validation-bootstrap_post form-horizontal" action="" method="post" >
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card">
                                <div class="card-header bg-blue bg-inverse">
                                  <h4>Add slider image</h4>
                                </div>
                                <div class="card-block card-block-full" >
                                  <div class="form-group">
                                      <label class="col-xs-12" for="old-password">Image url <span class="text-red">**</span></label>
                                      <div class="col-xs-12">
                                          <input class="form-control" type="text" id="txtTitle" name="txtTitle" placeholder="Enter post title here" value="" />
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-xs-12" for="old-password">Link url <span class="text-red">**</span></label>
                                      <div class="col-xs-12">
                                          <input class="form-control" type="text" id="txtTitle" name="txtTitle" placeholder="Enter post title here" value="" />
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-xs-12" for="old-password">Alt text<span class="text-red">**</span></label>
                                      <div class="col-xs-12">
                                          <input class="form-control" type="text" id="txtTitle" name="txtTitle" placeholder="Enter post title here" value="" />
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header bg-blue bg-inverse">
                                <h4>Slider list</h4>
                              </div>
                              <div class="card-block card-block-full" >
                                <div class="table-responsive">
                                  <table class="table table-striped">
                                    <thead>
                                      <th class="text-center" style="width: 50px;">
                                        #
                                      </th>
                                      <th>
                                        Image
                                      </th>
                                      <th class="hidden-xs w-20">
                                        Status
                                      </th>
                                      <th class="hidden-xs w-10">
                                        Action
                                      </th>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $strSQL = sprintf("SELECT * FROM tsd_slider WHERE 1 ORDER BY sld_id DESC LIMIT 0,40");
                                      $resultMedia = $db->select($strSQL,false,true);

                                      if($resultMedia){
                                        $c = 1;
                                        foreach ($resultMedia as $value) {
                                          ?>
                                          <tr>
                                            <td>
                                              <?php print $c; $c++; ?>
                                            </td>
                                            <td>
                                              <img src="<?php print $value['sld_image_url']?>" alt="<?php print $value['sld_alt'];?>" width="100%" />
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                              <div class="btn-group">
                                                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit client"><i class="ion-edit"></i></button>
                                                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove client"><i class="ion-close"></i></button>
                                              </div>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                      }else{
                                        ?>
                                        <tr>
                                          <td colspan="4">
                                            No data found!
                                          </td>
                                        </tr>
                                        <?php
                                      }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>

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
        <!-- End Apps Modal -->
        <div class="info_show">
          <div class="msg_data">
            <!--เนื้อหาใน popup message-->
          </div>
        </div>

        <div id="overlay"></div>

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
        <script src="../assets/js/plugins/dropzonejs/dropzone.min.js"></script>
        <!-- Page JS Code -->
        <script src="../assets/js/pages/base_tables_datatables.js"></script>

    </body>

</html>
<?php
function getFiletype($filename){

          $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
}
?>
