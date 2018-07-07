<div class="foter-menu row">
  <div class="col-sm-6">
    <h4><?php print $conf->getTitle(); ?><br><small><?php print $conf->getTitle_eng(); ?></small></h4>
    <div class="row">
      <div class="col-sm-12">
        <i class="fa fa-home"></i> <?php print $conf->getAddress(); ?>
      </div>
    </div>
    <div class="row" style="padding-top: 10px;">
      <div class="col-sm-12">
        <i class="fa fa-phone"></i> <?php print $conf->getPhone(); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <i class="fa fa-fax"></i> <?php print $conf->getFax(); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <i class="fa fa-envelope"></i> <?php print $conf->getEmail(); ?>
      </div>
    </div>
  </div>

  <div class="col-sm-3">
    <h4>Custom link</h4>
    <ul>
      <?php
      //$strSQL = sprintf("SELECT * FROM tsd_customlink WHERE li_status = 'Yes' LIMIT 0,8");
	$strSQL = "SELECT * FROM tsd_customlink WHERE li_status = 'Yes' LIMIT 0,8";
      $result = $db->select($strSQL,false,true);
	
      
      if($result){
        foreach($result as $value){
          ?>
          <li><a href="<?php print $value['li_url']; ?>" class="link-a" target="_blank"><?php print $value['li_title']; ?></a></li>
          <?php
        }
      }else{
	print "Access denine!";
	
      }
      ?>
    </ul>
  </div>

  <div class="col-sm-3">
    <h4>สถิติการเข้าชม</h4>
  </div>
</div>
