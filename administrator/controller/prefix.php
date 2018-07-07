<?php
session_start();
include "../../database/database.class.php";
$db = new database();
$db->connect();

if(isset($_POST['txtPrefixid'])){
  $strSQL = sprintf("UPDATE tb_prefix SET prefix = '%s' WHERE pre_id = '%s'", mysql_real_escape_string($_POST['txtPrefix']), mysql_real_escape_string($_POST['txtPrefixid']));
  $resultUpdate = $db->update($strSQL);

  $db->disconnect();
  header('Location: ../nameprefix.php');
  exit();
  
}else{
  $strSQL = sprintf("SELECT * FROM tb_prefix WHERE prefix = '%s'", mysql_real_escape_string($_POST['txtPrefix']));
  $result = $db->select($strSQL,false,true);

  if($result){
    $db->disconnect();
    header('Location: ../nameprefix.php?error=1');
    exit();
  }else{
    $strSQL = sprintf("INSERT INTO tb_prefix VALUES ('', '%s', 'Yes', 'Yes')", mysql_real_escape_string($_POST['txtPrefix']));
    $resultInsert = $db->insert($strSQL,false,true);

    if($resultInsert){
      $db->disconnect();
      header('Location: ../nameprefix.php');
      exit();
    }else{
      $db->disconnect();
      header('Location: ../nameprefix.php?error=2');
      exit();
    }
  }
}



?>
