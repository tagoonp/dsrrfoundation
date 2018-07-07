<?php
session_start();
include "../../database/database.class.php";
$db = new database();
$db->connect();

if(!isset($_GET['pre_id'])){

}else{
  $strSQL = sprintf("UPDATE `tb_prefix` SET std_status = '%s' WHERE pre_id = '%s'", mysql_real_escape_string($_GET['to']), mysql_real_escape_string($_GET['pre_id']));
  $resultDelete = $db->update($strSQL);

  header('Location: ../nameprefix.php');
  exit();
}
?>
