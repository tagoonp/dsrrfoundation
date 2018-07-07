<?php
$strSQL = "SELECT * FROM tsd_content WHERE cont_status = 'Yes' and ctg_id = '1' ORDER BY cont_id DESC limit 0,4";
$result = $db->select($strSQL,false,true);
if($result){
  $c = 0;
  foreach ($result as $value) {
    ?>
    <div class="row">
      <div class="col-sm-12" style="padding-bottom: 0px;" >
        <?php
        if($value['cont_content']=='[gfile:media]'){
          ?>
          <a href="<?php print $value['cont_url']; ?>" class="link-b" target="_blank"><?php print $value['cont_title']; ?></a>
          <?php
        }else{
          ?>
          <a href="<?php print $value['cont_url']; ?>" class="link-b"><?php print $value['cont_title']; ?></a>
          <?php
        }
        ?>
        <br>
        <p style="font-size: 0.8em;">
          โพสเมื่อ : <?php print $value['cont_publicdate']; ?> อ่าน : <?php print $value['cont_view']; ?> ครั้ง
        </p>
      </div>
    </div>
    <?php
  }
}
?>
