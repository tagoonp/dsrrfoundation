$(function(){
  $('#txtContentType').change(function(){
    if($('#txtContentType').val()==1){
      $('#fileDiv').css('display','none');
      $('#contentDiv').show();
    }else{
      $('#fileDiv').show();
      $('#contentDiv').css('display','none');
    }
  });
});

$(document).ready(function(){
  if($('#txtContentType').val()==1){
    $('#fileDiv').css('display','none');
    $('#contentDiv').show();
  }else{
    $('#fileDiv').show();
    $('#contentDiv').css('display','none');
  }
});

function showImageMedal(imageID){
  // alert(imageID);
  $("#overlay").fadeToggle("",function(){ // แสดงส่วนของ overlay
      $('body').css('overflow-y','hidden');
      $(".info_show").slideToggle("",function(){ // แสดงส่วนของ เนื้อหา popup
        if($(this).css("display")=="block"){        // ถ้าเป็นกรณีแสดงข้อมูล
          $.post("controller/medal-fileinfo.php",{ imgID: imageID },function(data){
              $(".msg_data").html(data);
          });
        }
      });
  });
}
