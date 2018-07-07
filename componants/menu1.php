<?php
$strSQL = sprintf("SELECT * FROM tsd_mainmenu WHERE ma_position = 0 AND ma_status = 'Yes' ORDER BY ma_order ");
$result = $db->select($strSQL,false,true);
?>
<nav class="navbar navbar-default2 navbar-static-top" style="">
  <div class="container">
    <div class="navbar-header" style="font-size: 0.6em;">
      <button type="button" id="nav-toggle-button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-left">
        <?php
        if($result){
          foreach ($result as $value) {
            $strSQL = "SELECT * FROM tsd_submenu WHERE ma_id = '".$value['ma_id']."' and sma_status = 'Yes' ORDER BY sma_order";
            $result = $db->select($strSQL,false,true);
            if($result){
              ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle link-b" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $value['ma_title']; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <?php
                foreach ($result as $value2) {
                  ?>
                  <li><a class="link-b" href="<?php print $value2['sma_url'];?>" ><?php print $value2['sma_title']; ?></a></li>
                  <?php
                }
                ?>
                </ul>
              </li>
              <?php
            }else{
              ?>
              <li><a class="link-b" href="<?php print $value['ma_url']; ?>"><?php print $value['ma_title']; ?></a></li>
              <?php
            }
          }
        }
        ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="./" class="link-b">ภาษาไทย</a></li> -->
        <li><a href="content_info.php?cid=33" class="link-b">English info.</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
