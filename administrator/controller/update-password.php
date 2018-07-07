<?php
session_start();
include "../../database/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM tb_student a inner join tb_user b on a.username = b.username WHERE b.username = '%s' and b.password = '%s' ", mysql_real_escape_string($_SESSION['sisSessuser']), mysql_real_escape_string($_POST['old-password']));
$resultCheck = $db->select($strSQL,false,true);
if(!$resultCheck){
  header('Location: ../changepassword-complete.php?category=2');
  exit();
}

$strSQL = sprintf("UPDATE tb_user SET
          password = '%s'
          WHERE username = '%s'",
          mysql_real_escape_string($_POST['new-password1']),
          mysql_real_escape_string($_SESSION['sisSessuser'])
        );
$resultUpdate = $db->update($strSQL,false,true);
if($resultUpdate){
  $db->disconnect();
  header('Location: ../changepassword-complete.php?category=1');
  exit();
}else{
  $db->disconnect();
  header();
  exit();
}
?>
