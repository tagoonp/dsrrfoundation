<?php
require_once "config/config.class.php";
$conf = new config();

require_once "config/database.class.php";
$db = new database();
$db->connect();

$web = $conf->getWeb();

if(!isset($_GET['cid'])){
  header('Location: 404-error.html');
  exit();
}

$strSQL = sprintf("SELECT * FROM tsd_content WHERE cont_id = '%s' ", mysql_real_escape_string($_GET['cid']));
$resultContent = $db->select($strSQL,false,true);

if(!$resultContent){
  header('Location: 404-error.html');
  exit();
}

if($resultContent[0]['cont_content']=='[gfile:media]'){
  $strSQL = sprintf("UPDATE tsd_content SET cont_view = '".(intval($resultContent[0]['cont_view']) + 1)."' WHERE cont_id = '%s'", mysql_real_escape_string($_GET['cid']));
  $resultUpdate = $db->update($strSQL);
  header('Location: media/'.$resultContent[0]['cont_file']);
  exit();
}

$strSQL = sprintf("UPDATE tsd_content SET cont_view = '".(intval($resultContent[0]['cont_view']) + 1)."' WHERE cont_id = '%s'", mysql_real_escape_string($_GET['cid']));
$resultUpdate = $db->update($strSQL);
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
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,300,200&subset=thai,latin' rel='stylesheet' type='text/css'>
    <title><?php print $resultContent[0]['cont_title']; ?></title>
    <style>
      .content-detail>h2{
        border: solid;
        border-width: 3px 0px 3px 0px;
        border-color: #608EDB;
        padding-top: 20px;
        padding-bottom: 20px;
        margin: 20px 0px;
      }
	
.content-detail>table>tbody>tr>td{
        font-weight: 200;
	padding: 0px 5px;
      }
	
    </style>
  </head>

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
      <div class="row" style="padding-top: 10px;">

      </div>
      <div class="row" style="padding-top: 0px; margin-top: 0px;">
        <div class="col-sm-9">
          <div class="row">
            <div class="col-sm-10" style="padding-top: 10px;">
              <a href="./" class="link-b">DSRR</a> /
              <?php
              switch($resultContent[0]['ctg_id']){
                case 1: ?> <a href="#" class="link-b">ข่าวประชาสัมพันธ์</a> <?php ; break;
                case 2: ?> <a href="#" class="link-b">กิจกรรม</a> <?php ; break;
                case 3: ?> <a href="#" class="link-b">สรุปเนื้อหาวิจัย</a> <?php ; break;
                case 4: ?> <a href="article.php" class="link-b">บทความ</a> <?php ; break;
                default: ?> <a href="#" class="link-b">ข้อมูลทั่วไป</a> <?php ; break;
              }
              ?>
            </div>
            <div class="col-sm-2">
              <div class="text-right" style="padding-top: 10px;">
                <button type="button" name="button" class="btn btn-default"><i class="fa fa-share-alt fa-1x" aria-hidden="true"></i></button>
                <button type="button" name="button" class="btn btn-default"><i class="fa fa-print fa-1x" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>

          <?php
          if($resultContent[0]['cont_cover']!=''){
            ?>
            <div class="content_box" style="padding-top: 20px;">
              <img src="<?php print $resultContent[0]['cont_cover']; ?>" alt="" class="img-responsive" />
            </div>
            <?php
          }
          ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="content-detail"   >
                <?php print $resultContent[0]['cont_content']; ?>
              </div>
            </div>
          </div>
          <div class="" style="padding: 20px 0px 20px 0px;">
            <hr>
            โพสเมื่อ : <span style="font-weight: 300;"><?php print $resultContent[0]['cont_publicdate']; ?></span> อ่าน : <span style="font-weight: 300;"><?php print intval($resultContent[0]['cont_view']) + 1; ?></span>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="panel-title" style="background: #06c; color: #fff;">
            <h4>โพสล่าสุด</h4>
          </div>
          <div class="panel-content">
            <?php
            include "componants/feeding-left.php";
            ?>
          </div>

          <div class="panel-title" style="background: #FFBB00; color: #fff;">
            <h4>Tags</h4>
          </div>
          <div class="panel-content" style="margin-bottom: 20px;" >
            <?php
            include "componants/feeding-tags.php";
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
