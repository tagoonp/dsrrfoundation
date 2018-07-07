<?php
session_start();
include "../../database/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM tb_student a inner join tb_user b on a.username = b.username WHERE b.username = '%s'", mysql_real_escape_string($_SESSION['sisSessuser']));
$resultCheck = $db->select($strSQL,false,true);
if(!$resultCheck){
  header();
  exit();
}

$strSQL = sprintf("UPDATE tb_student SET
          std_prefix = '%s',
          std_name = '%s',
          std_midname = '%s',
          std_surname = '%s',
          std_idcard = '%s',
          std_idcard_issue = '%s',
          std_idcard_expire = '%s',
          std_passport_id = '%s',
          std_passport_issue = '%s',
          std_passport_expire = '%s',
          std_visa_id = '%s',
          std_visa_issue = '%s',
          std_visa_expire = '%s',
          std_tel = '%s',
          std_email = '%s',
          std_hm_address = '%s',
          std_hm_tel = '%s',
          std_wk_address = '%s',
          std_wk_tel = '%s'
          WHERE std_id = '%s'",
          mysql_real_escape_string($_POST['txtPrefix']),
          mysql_real_escape_string($_POST['txtFname']),
          mysql_real_escape_string($_POST['txtMname']),
          mysql_real_escape_string($_POST['txtLname']),
          mysql_real_escape_string($_POST['txtPid']),
          mysql_real_escape_string($_POST['txtPidiss']),
          mysql_real_escape_string($_POST['txtPidexp']),
          mysql_real_escape_string($_POST['txtPassport']),
          mysql_real_escape_string($_POST['txtPassportiss']),
          mysql_real_escape_string($_POST['txtPassportexp']),
          mysql_real_escape_string($_POST['txtVisa']),
          mysql_real_escape_string($_POST['txtVisaiss']),
          mysql_real_escape_string($_POST['txtVisaexp']),
          mysql_real_escape_string($_POST['txtPhone']),
          mysql_real_escape_string($_POST['txtEmail']),
          mysql_real_escape_string($_POST['txtHaddress']),
          mysql_real_escape_string($_POST['txtHphone']),
          mysql_real_escape_string($_POST['txtWaddress']),
          mysql_real_escape_string($_POST['txtWphone']),
          mysql_real_escape_string($_SESSION['sisSessuser'])
        );
$resultUpdate = $db->update($strSQL,false,true);
if($resultUpdate){
  $db->disconnect();
  header('Location: ../');
  exit();
}else{
  $db->disconnect();
  header();
  exit();
}
?>
