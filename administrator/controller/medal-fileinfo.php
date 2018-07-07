<?php
include "../../config/database.class.php";
$db = new database();
$db->connect();

$result = false;
if(isset($_POST['imgID'])){
  $strSQL = sprintf("SELECT * FROM tsd_media WHERE media_id = '%s'", mysql_real_escape_string($_POST['imgID']));
  $result = $db->select($strSQL,false,true);
  if(!$result){
    print "asd";
    exit();
  }
}else{
  print "sss";
}
?>
<link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
<!-- <link rel="stylesheet" href="css/style.css" charset="utf-8"> -->
<div class="row">
  <div class="col-sm-12 text-right">
    <div style="padding: 5px 10px;">
      <i class="fa fa-close fa-1x" id="btnCancle" style="cursor: pointer;"></i>
    </div>
  </div>
</div>

<div class="" style="margin: 0px; padding: 20px;">
  <form class="" name="loginForm" id="LoginForm">
    <div class="row">
      <div class="col-sm-8 text-center">
        <img src="<?php print $result[0]['media_url']; ?>" alt="" width="60%" />
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label class="col-xs-12" for="old-password">URL </label>
            <div class="col-xs-12">
                <input class="form-control" type="text" id="txtUrl" name="txtUrl" readonly placeholder="Enter post title here" value="<?php if($result){  print $result[0]['media_url']; }?>" />
            </div>
        </div>

        <div class="form-group" >
            <label class="col-xs-12" style="padding-top: 15px;" for="old-password">Title <span class="text-red">**</span></label>
            <div class="col-xs-12">
                <input class="form-control" type="text" id="txtTitle" name="txtTitle"  placeholder="Enter image title here" value="<?php if($result){  print $result[0]['media_title']; }?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12" for="old-password"  style="padding-top: 15px;">Alt text <span class="text-red">**</span></label>
            <div class="col-xs-12">
                <input class="form-control" type="text" id="txtAlttext" name="txtAlttext"  placeholder="Enter alt text here" value="<?php if($result){  print $result[0]['media_alt_text']; }?>" />
            </div>
        </div>

        <div class="form-group m-b-0">
            <div class="col-xs-12" style="padding-top: 15px;">
                <button class="btn btn-app-blue btn-block" type="submit">Update</button>
            </div>
        </div>

      </div>
    </div>
  </form>
</div>


<script type="text/javascript">
  $(function(){

    $('#btnCancle').click(function(){
      $("#overlay").fadeToggle();
			$(".info_show").slideToggle();
      $('body').css('overflow-y','scroll');
    });

    $('#LoginForm').submit(function(){
      var check = 0;
      $("#overlay").fadeToggle();
      $(".doctor_show").slideToggle();
      $('.form-control').removeClass('ms-required');

      if($('#txtUsername').val()==''){
        $('#txtUsername').addClass('ms-required');
        check++;
      }

      if($('#txtPassword').val()==''){
        $('#txtPassword').addClass('ms-required');
        check++;
      }

      if(check!=0){
        return false;
      }else{
        $.post("core/authentication.php", {
          username: $('#txtUsername').val(),
          password: $('#txtPassword').val()
          },
          function(result){
            if(result=='Y'){
              window.location = 'core/redirect_user.php?aut_t=1';
            }else{
              swal("ขออภัย!", "ไม่พบข้อมูลบัญชีผู้ใช้ดังกล่าว หรือ รหัสผ่านผิดพลาด!" + result, "warning");
            }
          }
        );
        return false;
      }
      return false;
    });


    $('#txtUsername').keyup(function(){
      if($('#txtUsername').val()!=''){
        $('#txtUsername').removeClass('required');
      }
    });

    $('#txtPassword').keyup(function(){
      if($('#txtPassword').val()!=''){
        $('#txtPassword').removeClass('required');
      }
    });

  });
</script>
<style media="screen">
  .ms-required{
    border-color: red;
  }
</style>
