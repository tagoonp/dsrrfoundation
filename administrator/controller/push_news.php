<?php
session_start();
header("Access-Control-Allow-Origin: *");
include "../../config/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM tsd_user WHERE username = '%s'", mysql_real_escape_string($_POST['user']));
$result1 = $db->select($strSQL,false,true);
if(!$result1){
  echo $strSQL;
  $db->disconnect();
  die();
}

$strSQL = "SELECT max(cont_id) last_id FROM tsd_content WHERE 1";
$resultMax = $db->select($strSQL,false,true);

$maxnew = 1;
if($resultMax){
  $maxnew = intval($resultMax[0]['last_id']) + 1;
}

$img = '';
if(!$_POST['figure'] == ''){
  $img = $_POST['figure'];
}

$img_tmp = '';
if(!$_POST['figure_tmp'] == ''){
  $img_tmp = $_POST['figure_tmp'];
}

$edate = '';
if(!$_POST['event_date'] == ''){
  $edate = $_POST['event_date'];
  $edate = explode(' ', $edate);
}

$strSQL = sprintf("INSERT INTO tsd_content (cont_id, cont_title, cont_content, cont_url, cont_publicdate, cont_adddate, cont_cover, cont_indexcover, ctg_id, cont_status, username) VALUES ('%s', '%s', '%s','%s','%s','%s','%s','%s','%s', '%s','%s')",
          mysql_real_escape_string($maxnew),
          mysql_real_escape_string($_POST['title']),
          mysql_real_escape_string($_POST['content']),
          mysql_real_escape_string('content_info.php?cid='.$maxnew),
          mysql_real_escape_string($edate[0]),
          mysql_real_escape_string(date('Y-m-d')),
          mysql_real_escape_string($img),
          mysql_real_escape_string($img_tmp),
          mysql_real_escape_string('5'),
          mysql_real_escape_string('Yes'),
          mysql_real_escape_string('DSRR-Connet')
        );
$resultInsert = $db->insert($strSQL,false,true);

// print $strSQL;
// exit();
if($resultInsert){

  // echo $strSQL;
  //
  // $strSQL = sprintf("UPDATE tsd_content SET cont_content = '%s', cont_file = '%s' WHERE cont_id ='".($maxnew)."'",
  //           mysql_real_escape_string('[gfile:media]'),
  //           mysql_real_escape_string($_POST['txtFileUrl'])
  //           );
  // $resultUpdate = $db->update($strSQL);

  echo "Y";
  $db->disconnect();
  exit();
}else{
  echo "N";
  $db->disconnect();
  exit();
}
?>
