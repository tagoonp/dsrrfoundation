$(function(){
  $('.loginForm').submit(function(){
    $check = 0;
    $('#alertMsg').hide();
    $('.form-group').removeClass('has-error');
    if($('#frontend_login_email').val()==''){
      $('#req1').addClass('has-error');
      $check++;
    }
    if($('#frontend_login_password').val()==''){
      $('#req2').addClass('has-error');
      $check++;
    }

    if($check!=0){
      return false;
    }
  });
});
