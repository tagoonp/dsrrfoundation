<?php
$strSQL = "SELECT * FROM tsd_content WHERE cont_indexpin = 'Yes' and ctg_id = '4'";
$result = $db->select($strSQL,false,true);
if($result){
  foreach ($result as $value) {
    ?>
    <div class="row">
      <div class="col-sm-4"  style="padding-top: 10px;">
        <a href="<?php print $value['cont_url']; ?>" alt="<?php print $value['cont_title']; ?>" ><img src="media/<?php print $value['cont_indexcover']; ?>" alt="" class="img-responsive" /></a>
      </div>
      <div class="col-sm-8" style="margin-top: -10px;">
        <!-- <h3>หนังสือเยียวยาในไฟใต้</h3>
        <p>
          หนังสือสะท้อนให้เห็นประสบการณ์ของผู้ประกอบวิชาชีพด้านสาธารณสุขในพื้นที่ไฟใต้ และความร่วมมือระดับนนาชาติในการแบ่งปันแลกเปลี่ยนความคิดเห็นและรูปแบบวิธีดำเนินการในการทำงานในพื้นที่แห่งความขัดแย้ง เพื่อปูหนทางสู่งานสร้างสันติภาพ
        </p>
        <p>
          <i>หากต้องการหนังสือฯ</i>... สามารถรับด้วยตัวท่านเองที่มูลนิธิฯ
    ชั้น 6  อาคารบริหาร คระแพทยศาสตร์ ม.สงขลานครินทร์
        </p> -->
        <a href="<?php print $value['cont_url']; ?>" alt="<?php print $value['cont_title']; ?>" class="link-b" >
          <?php print $value['cont_content']; ?>
        </a>
      </div>
    </div>
    <?php
  }
}
?>
