<?php
session_start();
include "../../database/database.class.php";
$db = new database();
$db->connect();

if(!isset($_GET['pre_id'])){

}else{
  $strSQL = sprintf("UPDATE tb_student SET std_prefix = '11' WHERE std_prefix = '%s'", mysql_real_escape_string($_GET['pre_id']));
  $resultUpdate = $db->update($strSQL);

  $strSQL = sprintf("DELETE FROM `tb_prefix` WHERE pre_id = '%s'", mysql_real_escape_string($_GET['pre_id']));
  $resultDelete = $db->delete($strSQL);

  header('Location: ../nameprefix.php');
  exit();
}
?>
