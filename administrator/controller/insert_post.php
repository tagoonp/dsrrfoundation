<?php
session_start();
include "../../config/database.class.php";
$db = new database();
$db->connect();

// $strSQL = sprintf("SELECT * FROM tb_student a inner join tb_user b on a.username = b.username WHERE b.username = '%s'", mysql_real_escape_string($_SESSION['sisSessuser']));
// $resultCheck = $db->select($strSQL,false,true);
// if(!$resultCheck){
//   header();
//   exit();
// }

$strSQL = "SELECT max(cont_id) last_id FROM tsd_content WHERE 1";
$resultMax = $db->select($strSQL,false,true);

$maxnew = 1;
if($resultMax){
  $maxnew = intval($resultMax[0]['last_id']) + 1;
}

$strSQL = sprintf("INSERT INTO tsd_content (cont_id, cont_title, cont_url, cont_publicdate, cont_adddate, cont_cover, cont_indexcover, ctg_id, cont_status, username) VALUES ('%s', '%s','%s','%s','%s','%s','%s','%s', '%s','%s')",
          mysql_real_escape_string($maxnew),
          mysql_real_escape_string($_POST['txtTitle']),
          mysql_real_escape_string('content_info.php?cid='.$maxnew),
          mysql_real_escape_string($_POST['txtEventdate']),
          mysql_real_escape_string(date('Y-m-d')),
          mysql_real_escape_string($_POST['txtCover']),
          mysql_real_escape_string($_POST['txtIndexcover']),
          mysql_real_escape_string($_POST['txtCategory']),
          mysql_real_escape_string('Yes'),
          mysql_real_escape_string($_SESSION['dsrrSessuser'])
        );
$resultInsert = $db->insert($strSQL,false,true);

// print $strSQL;
// exit();
if($resultInsert){

  // -- If content type
  // -- If type == content
  if($_POST['txtContentType']==1){
    $strSQL = sprintf("UPDATE tsd_content SET cont_content = '%s', cont_file = '' WHERE cont_id ='".($maxnew )."'",
              mysql_real_escape_string($_POST['editor1'])
              );
    $resultUpdate = $db->update($strSQL);
  }
  // -- If type == file
  else{
    $strSQL = sprintf("UPDATE tsd_content SET cont_content = '%s', cont_file = '%s' WHERE cont_id ='".($maxnew)."'",
              mysql_real_escape_string('[gfile:media]'),
              mysql_real_escape_string($_POST['txtFileUrl'])
              );
    $resultUpdate = $db->update($strSQL);
  }

  // --- Insert tag for artivle ---
  $tag = $_POST['txtTag'];
  $buffTag = '';
  if(trim($tag)!=''){
    $buffTag = explode(',', $tag);
  }

  if(sizeof($buffTag)>0){
    foreach($buffTag as $tagValue){
      $strSQL = "INSERT INTO tsd_tags VALUE ('','".$tagValue."','".$maxnew."')";
      $resultTag = $db->insert($strSQL,false,true);
    }
  }
  // --- End insrtion tag ---

  $db->disconnect();
  header('Location: ../post.php');
  exit();
}else{
  $db->disconnect();
  header();
  exit();
}
?>
