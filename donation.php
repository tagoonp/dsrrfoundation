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
    <title>บริจาคสมทบทุน<?php print $conf->getTitle(); ?></title>
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
          <a href="./" class="link-b">DSRR</a> / <a href="#" class="link-b">การรับบริจาค</a>
        </div>
      </div>
      <!-- Main content homepage -->
      <div class="cont-menu row" style="margin-top: 10px; padding-bottom: 20px;">
        <div class="col-sm-12">
          <!-- Panel 2 -->
          <div class="panel-title" style="background: #00D18D; color: #fff;">
            <h4>ร่วมบริจาคสมทบทุนมูลนิธิฯ </h4>
          </div>
          <div class="panel-content">
            ท่านสามารถร่วมบริจาคเงินได้ โดยโอนเข้าบัญชี มูลนิธิเพื่อการเยียวยาและสร้างความสมานฉันท์ชายแดนใต้... ได้ที่
            <div class="text-center">
              <img src="images/SCB_logo2.png" alt="" />
            </div>
            <p class="text-center">
              <span style="font-size: 18px;">ธนาคารไทยพาณิชย์<br>
              สาขามหาวิทยาลัยสงขลานครินทร์ วิทยาเขตหาดใหญ่<br>
              บัญชีออมทรัพย์  เลขที่ <span style="font-size: 24px; color: #EC002E;">565-4-324694</span><br>
              ชื่อบัญชี <span style="color: #065FA3;">มูลนิธิเพื่อการเยียวยาและสร้างความสมานฉันท์ชายแดนใต้</span>
              </span>
            </p>
          </div>
        </div>
        <!-- End col-sm-6 -->
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
    <script type="text/javascript" language="javascript1.1" src="http://tracker.stats.in.th/tracker.php?sid=68649"></script><noscript><a target="_blank" href="http://www.stats.in.th/">www.Stats.in.th</a></noscript>
  </body>
</html>
