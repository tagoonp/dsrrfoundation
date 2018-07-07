<?php
session_start();
include "../../config/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM tsd_user WHERE username = '%s' and password = '%s' and 	user_status = 'Yes' and usertype_id = '1'",
          mysql_real_escape_string($_POST['frontend_login_email']),
          mysql_real_escape_string(md5($_POST['frontend_login_password'])));
$result = $db->select($strSQL,false,true);

// exit();
if($result){
  $_SESSION['dsrrSessid'] = session_id();
  $_SESSION['dsrrSessuser'] = $result[0]['username'];
  session_write_close();

  $db->disconnect();
  switch($result[0]['usertype_id']){
    case 1: header('Location: ../../administrator/'); exit(); break;
    default: header('Location: ../../authen-error.html'); exit();
  }
}else{
  $db->disconnect();
  header('Location: ../authen-error.html');
  exit();
}
?>
