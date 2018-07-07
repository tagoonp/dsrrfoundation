<?php
$strSQL = sprintf("SELECT * FROM tsd_content WHERE ctg_id != 99 AND cont_status = 'Yes' ORDER BY cont_publicdate DESC LIMIT 0,8");
$result = $db->select($strSQL,false,true);

if($result){
  foreach ($result as $value) {
    ?>
    <li><a class="link-b" href="<?php print $value['cont_url']; ?>"><?php print $value['cont_title']; ?></a></li>
    <?php
  }
}

?>
