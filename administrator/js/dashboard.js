$(function(){
  $('#infoForm').submit(function(){
    $check = 0;
    $('.form-group').removeClass('has-error');

    if($('#txtPrefix').val()==''){
      $check++;
      $('#req1').addClass('has-error');
    }

    if($('#txtFname').val()==''){
      $check++;
      $('#req2').addClass('has-error');
    }

    if($('#txtEmail').val()==''){
      $check++;
      $('#req3').addClass('has-error');
    }

    if($check!=0){
      return false;
    }

  });
});
