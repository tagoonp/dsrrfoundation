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
    <title><?php print $conf->getTitle(); ?></title>
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

    <!-- Include menu position1 -->
    <?php include "componants/menu1.php"; ?>
    <!-- End menu position1 -->

    <div class="container dsd" style="background: #fff;">
      <div class="row" style="padding-top: 10px;">

      </div>
      <div class="row" style="padding-top: 0px; margin-top: 0px;">
        <div class="col-lg-12">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                $strSQL = sprintf("SELECT * FROM tsd_slider WHERE sld_status = 'Yes' ORDER BY sld_id DESC LIMIT 0,10");
                $resultMedia = $db->select($strSQL,false,true);

                if($resultMedia){
                  $c = 0;
                  foreach($resultMedia as $value){
                    ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php print $c; ?>" class="<?php if($c==0){ print "active"; }?>"></li>
                    <?php
                    $c++;
                  }
                }
                ?>
              </ol>
              <div class="carousel-inner" role="listbox">
                <?php


                if($resultMedia){
                  $c = 1;
                  foreach ($resultMedia as $value) {
                    if($value['sld_url']!=''){
                      ?>
                      <div class="item <?php if($c==1){ print "active"; }?>">
                        <a href="<?php print $value['sld_url']; ?>"><img src="<?php print $value['sld_image_url']?>" alt="<?php print $value['sld_alt'];?>"></a>
                      </div>
                      <?php
                    }else{
                      ?>
                      <div class="item <?php if($c==1){ print "active"; }?>">
                        <img src="<?php print $value['sld_image_url']?>" alt="<?php print $value['sld_alt'];?>">
                      </div>
                      <?php
                    }

                    $c++;
                  }
                }
                ?>

              </div>
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
      </div>

      <!-- Main content homepage -->
      <div class="cont-menu row" style="margin-top: 20px; padding-bottom: 20px;">
        <div class="col-sm-6">
          <!-- Panel 1 -->
          <div class="panel-title" style="background: #0E7ED4; color: #fff;">
            <h4>ยินดีต้อนรับ</h4>
          </div>
          <div class="panel-content">
            <h4 style="color: #EC002E;"><i>"สู่การเยียวยาที่ยั่งยืน สร้างสมานฉันท์และสันติสุข"</i></h4>
            <p>
              ภารกิจที่สำคัญยิ่ง คือ <span style="color: #065FA3;">การเยียวยาผู้ประสบเหตุความไม่สงบให้ได้รับผลกระทบจากความสูญเสียให้น้อยที่สุด</span> ช่วยให้เขาสามารถดำเนินชีวิตอยู่ต่อไปได้ โดยมีกำลังในการปรับตัวต่อสู้จัดการกับอุปสรรคประการ
            </p>

            <h4 style="color: #EC002E;"><i>มูลนิธิเพื่อการเยียวยาและสร้างความสมานฉันท์ชายแดนใต้</i></h4>
            <p>
              ก่อตั้งขึ้นเมื่อวันที่ 19 มกราคม 2553 เป็นองค์กรในรูปแบบมูลนิธิ ที่บริหารจัดการโดยคณะบุคคลที่มีความโปร่งใส และมีประสบการณ์จากการปฏิบัติงานในกระเด็นของการเยียวยาในพื้นที่ และสามารถส่งต่อความต้องการการช่วยเหลือของผู้ได้รับผลกระทบในจังหวัดชายแดนใต้
            </p>
          </div>

          <div class="panel-title" style="background: #395C00; color: #fff;">
            <h4>ข่าวประชาสัมพันธ์ </h4>
          </div>
          <div class="panel-content">
            <!-- <ul> -->
              <?php include "componants/annoucement.php"; ?>
            <!-- </ul> -->
          </div>

          <div class="panel-title" style="background: #FE5860; color: #fff;">
            <h4>กิจกรรมเยียวยา </h4>
          </div>
          <div class="panel-content">
            <!-- <ul> -->
              <?php include "componants/reconciliation.php"; ?>
            <!-- </ul> -->
          </div>

          <div class="panel-title" style="background: teal; color: #fff;">
            <h4>งาน / นิทรรศการ <small></h4>
          </div>
          <div class="panel-content" style="padding: 0px;">
            <img src="http://dsrrfoundation.org/media/2016-07-06_b1jmt_13592557_10154375601377287_196593803170586314_n.jpg" alt="" class="img-responsive"/>
          </div>

          <div class="panel-title" style="background: #F32B75; color: #fff;">
            <h4>บทความ <small><i><a href="article.php" class="link-a">[ อ่านทั้งหมด ]</a></i></small></h4>
          </div>
          <div class="panel-content">
            <?php include "componants/article1.php"; ?>
            <hr>
            <?php include "componants/article2.php"; ?>
          </div>
        </div>
        <!-- End col-sm-6 -->

        <div class="col-sm-6">
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

          <div class="panel-title" style="background: #FFB400; color: #fff;">
            <h4>กิจกรรม <small><i><a href="activity.php" class="link-a">[ อ่านทั้งหมด ]</a></i></small></h4>
          </div>
          <div class="panel-content">
            <!-- <ul> -->
              <?php include "componants/activity.php"; ?>
            <!-- </ul> -->
          </div>

          <div class="panel-title" style="background: #A92F15; color: #fff;">
            <h4>ภาคีเครือข่าย</h4>
          </div>
          <div class="panel-content">
            <div class="row">
              <div class="col-sm-6">
                <a href="http://www.deepsouthwatch.org/" target="_blank"><img src="images/banners/deepsouthwatch.png" alt="" class="img-responsive" /></a>
              </div>
              <div class="col-sm-6">
                <a href="http://www.isranews.org/" target="_blank"><img src="images/banners/isranews.png" alt="" class="img-responsive"  /></a>
              </div>
            </div>
            <div class="row" style="padding-top: 10px;">
              <div class="col-sm-6">
                <a href="http://www.deepsouthvis.org/" target="_blank"><img src="images/banners/vis.png" alt="" class="img-responsive" /></a>
              </div>
              <div class="col-sm-6">
                <a href="http://medipe2.psu.ac.th/~dscc/dsccmis/" target="_blank"><img src="images/banners/dsccmis.png" alt="" class="img-responsive"  /></a>
              </div>
            </div>

            <div class="row" style="padding-top: 10px;">
              <div class="col-sm-6">
                <a href="http://www.sbpac.go.th/" target="_blank"><img src="images/banners/sbpac.png" alt="" class="img-responsive" /></a>
              </div>
              <div class="col-sm-6">
                <a href="http://www.mhc12.go.th/index.php/th/" target="_blank"><img src="http://dsrrfoundation.org/media/2016-06-19_Pk4dN_mhc12.png" alt="" class="img-responsive"  /></a>
              </div>
            </div>

	           <div class="row" style="padding-top: 10px;">
              <div class="col-sm-6">
                <a href="http://www.sasuk12.com/shdac/" target="_blank"><img src="http://dsrrfoundation.org/media/2016-06-19_QFEc2_sasuk12.png" alt="" class="img-responsive" /></a>
              </div>
              <div class="col-sm-6">
               &nbsp;
              </div>
            </div>

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

    <script type="text/javascript" src="library/wizn/js/stats.js"></script>
    <script type="text/javascript" language="javascript1.1" src="http://tracker.stats.in.th/tracker.php?sid=68649"></script><noscript><a target="_blank" href="http://www.stats.in.th/">www.Stats.in.th</a></noscript>
  </body>
</html>
