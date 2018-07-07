<?php
$strSQL = sprintf("SELECT * FROM tsd_user a inner join tsd_userinfo b on a.username = b.username WHERE a.username = '%s' ", mysql_real_escape_string($_SESSION['dsrrSessuser']));
$resultRecord = $db->select($strSQL,false,true);


if(!$resultRecord){
  $db->disconnect();
  header('Location: ../404-error.html');
  exit();
}
?>
