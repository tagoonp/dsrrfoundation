<?php
$strSQL = sprintf("SELECT * FROM tsd_tags WHERE cont_id = '".$_GET['cid']."' ");
$result = $db->select($strSQL,false,true);

if($result){
  foreach ($result as $value) {
    ?>
    <a style="line-height: 30px;" href="tags.php?title=<?php print $value['tags_title'];?>" alt="<?php print $value['tags_title'];?>"><span class="label label-info" style="font-size: 12px; font-weight:300;"><?php print $value['tags_title'];?></span></a>
    <?php
  }
}

?>
