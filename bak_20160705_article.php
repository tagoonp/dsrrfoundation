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

    <!-- Include JS file -->
    <script type="text/javascript" src="library/jquery/jquery.js"></script>
    <script type="text/javascript" src="library/bootstrap/js/bootstrap.js"></script>

    <!-- Include CSS file -->
    <link rel="stylesheet" type="text/css" href="library/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="library/wizn/css/wizn.css" />
    <link rel="stylesheet" href="library/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,200&subset=thai,latin' rel='stylesheet' type='text/css'>
    <title>บทความเยียวยา</title>
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
          <a href="./" class="link-b">DSRR</a> / <a href="#" class="link-b">บทความ</a>
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
            <p class="text-center">
              <ul>


              <?php
              $strSQL = sprintf("SELECT * FROM tsd_content WHERE ctg_id = '%s' and cont_status = 'Yes' ORDER BY cont_id desc", mysql_real_escape_string('4'));
              $resultArticle = $db->select($strSQL,false,true);
              if($resultArticle){
                foreach ($resultArticle as $value) {
                  if($value['cont_content']=='[gfile:media]'){
                    ?>
                      <li><a href="content_info.php?cid=<?php print $value['cont_id']; ?>" class="link-b" target="_blank"><?php print $value['cont_title']; ?></a>
                        <br>
                        โพสเมื่อ : <span style="font-weight: 300;"><?php print $value['cont_publicdate']; ?></span>
                        อ่าน : <span style="font-weight: 300;"><?php print $value['cont_view']; ?> ครั้ง</span>
                      </li>
                    <?php
                  }else{
                    ?>
                      <li><a href="content_info.php?cid=<?php print $value['cont_id']; ?>" class="link-b"><?php print $value['cont_title']; ?></a>
                        <br>
                        โพสเมื่อ : <span style="font-weight: 300;"><?php print $value['cont_publicdate']; ?></span>
                        อ่าน : <span style="font-weight: 300;"><?php print $value['cont_view']; ?> ครั้ง</span>
                      </li>
                    <?php
                  }
                }
              }
              ?>

              </ul>
            </p>
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
  </body>
</html>
