<?php
require_once "config/config.class.php";
$conf = new config();

require_once "config/database.class.php";
$db = new database();
$db->connect();

$web = $conf->getWeb();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="title" content="มูลนิธิเพื่อการเยียวยาและสร้างความสมานฉันท์ชายแดนใต้ มยส." />
    <meta name="description" content="องค์กรในรูปแบบมูลนิธิ ที่บริหารจัดการโดยคณะบุคคลที่มีความโปร่งใส และมีประสบการณ์จากการปฏิบัติงานในกระเด็นของการเยียวยาในพื้นที่ และสามารถส่งต่อความต้องการการช่วยเหลือของผู้ได้รับผลกระทบในจังหวัดชายแดนใต้" />
    <meta name="keywords" content="มูลนิธิเพื่อการเยียวยาและสร้างความสมานฉันท์ชายแดนใต้, มยส, The Deep South Relief and Reconciliation Foundation, DSRR" />
    <meta name="author" content="Wisnior">
    <meta name="copyright" content="dsrrfoundation.org" />

    <!-- Include JS file -->
    <script type="text/javascript" src="library/jquery/jquery.js"></script>
    <script type="text/javascript" src="library/bootstrap/js/bootstrap.js"></script>

    <!-- Include CSS file -->
    <link rel="stylesheet" type="text/css" href="library/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="library/wizn/css/wizn.css" />
    <link rel="stylesheet" href="library/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,200&subset=thai,latin' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="assets/js/plugins/datatables/jquery.dataTables.min.css" />

    <!-- AppUI CSS stylesheets -->
    <!-- <link rel="stylesheet" id="css-font-awesome" href="assets/css/font-awesome.css" /> -->
        <link rel="stylesheet" id="css-ionicons" href="assets/css/ionicons.css" />
    <link rel="stylesheet" id="css-app" href="assets/css/app.css" />
    <!-- <link rel="stylesheet" id="css-app-custom" href="assets/css/app-custom.css" /> -->
    <!-- End Stylesheets -->
    <title>กิจกรรมเยียวยา</title>
  </head>

  <!-- Fixed navbar -->


  <!-- End fixed navbar -->
  <body>
    <div class="container-fluid" style="padding-top: 0px; background: #00ccff; padding-bottom: 20px;">
      <div class="foter-menu2 row" style="font-size: 1.0em; background: #FF8C00;">
        <div class="col-sm-6">
          <a href="<?php print $web;?>" class="link-a"><i class="fa fa-home"></i></a>&nbsp;&nbsp;
          |&nbsp;&nbsp;<a href="<?php print $conf->getFacebook();?>" class="link-a" target="_blank"><i class="fa fa-facebook-square"></i> <?php print $conf->getFacebook_title();?></a>
        </div>
        <div class="col-sm-6 text-right">
          <a href="./authen/" class="link-a"><i class="fa fa-lock"></i> Login</a>
        </div>
      </div>
      <div class="container">
        <div class="row" style="padding-top: 10px;">
          <div class="col-md-9">
            <img src="images/logo-dsrr4.png" alt="" style="width: 100%;"  />
          </div>
        </div>
      </div>

    </div>
    <?php include "componants/menu1.php"; ?>
    <div class="container dsd" style="background: #fff;">
      <div class="row">
        <div class="col-sm-10" style="padding-top: 20px;">
          <a href="./" class="link-b">DSRR</a> / <a href="#" class="link-b">กิจกรรมเยียวยา</a>
        </div>
      </div>
      <!-- Main content homepage -->
      <div class="cont-menu row" style="margin-top: 10px; padding-bottom: 20px; ">
        <div class="col-sm-9">
          <!-- Panel 2 -->
          <div class="panel-title" style="background: #00D18D; color: #fff;">
            <h4>บทความเยียวยา</h4>
          </div>
          <div class="panel-content" style="padding-bottom: 30px;">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
              <thead>
                  <tr>
                      <th class="text-center"></th>
                      <th>บทความ</th>
                      <th class="hidden-xs">อ่าน</th>
                      <th class="hidden-xs w-20">โพสเมื่อ</th>
                      <th class="text-center" style="width: 10%; display:none;">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $strSQL = sprintf("SELECT * FROM tsd_content WHERE ctg_id = '%s' and cont_status = 'Yes' ORDER BY cont_id desc", mysql_real_escape_string('5'));
                $resultArticle = $db->select($strSQL,false,true);
                if($resultArticle){
                  $c = 1;
                  foreach ($resultArticle as $value) {
                    ?>
                    <tr>
                        <td class="text-center"><?php print $c; ?></td>
                        <td class="font-500">
                          <?php
                          if($value['cont_content']=='[gfile:media]'){
                            ?>
                            <a href="content_info.php?cid=<?php print $value['cont_id']; ?>" class="link-b" target="_blank"><?php print $value['cont_title']; ?></a>
                            <?php
                          }else{
                            ?>
                            <a href="content_info.php?cid=<?php print $value['cont_id']; ?>" class="link-b"><?php print $value['cont_title']; ?></a>
                            <?php
                          }
                          ?>
                        </td>

                        <td class="hidden-xs"><?php print $value['cont_view']; ?></td>
                        <td class="hidden-xs"><?php print $value['cont_publicdate']; ?></td>

                        <td class="text-center" style="display:none;">
                                                <div class="btn-group">
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit Client"><i class="ion-edit"></i></button>
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Client"><i class="ion-close"></i></button>
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
        <!-- End col-sm-9 -->
        <div class="col-sm-3">
          <div class="panel-title" style="background: #06c; color: #fff;">
            <h4>โพสล่าสุด</h4>
          </div>
          <div class="panel-content">
            <?php
            include "componants/feeding-left.php";
            ?>
          </div>
        </div>
      </div>


      <!-- Footer -->
      <footer>
        <?php
        include "componants/footer.php";
        ?>

        <div class="foter-menu2 row">
          <div class="col-sm-6 text-left">
            Template by Wizn
          </div>
          <div class="col-sm-6 text-right">
            Copyright <i class="fa fa-copyright"></i> 2016 - <a href="http://www.wisnior.com" class="link-a">Wisnior</a>
          </div>
        </div>
      </footer>

    </div>

    <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="assets/js/core/jquery.placeholder.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/app-custom.js"></script>

    <!-- Page JS Plugins -->
    <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

    <!-- Page JS Code -->
    <script src="assets/js/pages/base_tables_datatables.js"></script>
    <script type="text/javascript" language="javascript1.1" src="http://tracker.stats.in.th/tracker.php?sid=68649"></script><noscript><a target="_blank" href="http://www.stats.in.th/">www.Stats.in.th</a></noscript>
  </body>
</html>
