<?php
$strSQL = "SELECT * FROM tsd_content WHERE cont_status = 'Yes' and ctg_id = '2' ORDER BY cont_publicdate DESC limit 0,6";
$result = $db->select($strSQL,false,true);
if($result){
  $c = 0;
  foreach ($result as $value) {
    ?>
    <div class="row" style="padding-bottom: 10px;">
      <div class="col-sm-6">
        <?php
        if($value['cont_indexcover']==''){
          if($value['cont_cover']!=''){
            ?>
            <a href="<?php print $value['cont_url']; ?>" class="link-b"><img src="<?php print $value['cont_cover']; ?>" alt="<?php print $value['cont_title']; ?>" class="img-responsive" /></a>
            <?php
          }else{
            ?>

            <?php
          }
        }else{
          ?>
          <a href="<?php print $value['cont_url']; ?>" class="link-b"><img src="<?php print $value['cont_indexcover']; ?>" alt="<?php print $value['cont_title']; ?>" class="img-responsive" /></a>
          <?php
        }
        ?>

      </div>
      <div class="col-sm-6" style="padding-bottom: 20px;" >
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
