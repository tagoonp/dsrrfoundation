/*
Document: base_forms_validation.js
Author: Rustheme
Description: Custom JS code used in Form Validation Page
 */

var BaseFormValidation = function() {
    // Init Bootstrap Forms Validation: https://github.com/jzaefferer/jquery-validation
    var initValidationBootstrap_changepassword = function() {
        jQuery( '.js-validation-bootstrap' ).validate({
            errorClass: 'help-block animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function( error, e ) {
                jQuery(e).parents( '.form-group > div' ).append( error );
            },
            highlight: function(e) {
                jQuery(e).closest( '.form-group' ).removeClass( 'has-error' ).addClass( 'has-error' );
                jQuery(e).closest( '.help-block' ).remove();
            },
            success: function(e) {
                jQuery(e).closest( '.form-group' ).removeClass( 'has-error' );
                jQuery(e).closest( '.help-block' ).remove();
            },
            rules: {
                'old-password': {
                    required: true,
                    minlength: 6
                },
                'new-password1': {
                    required: true,
                    minlength: 6
                },
                'new-password2': {
                    required: true,
                    minlength: 6,
                    equalTo: '#new-password1'
                }

            },
            messages: {
                'old-password': {
                    required: 'Please enter your old password',
                    minlength: 'Your password must consist of at least 6 characters'
                },
                'new-password1': {
                    required: 'Please enter your new password',
                    minlength: 'Your password must consist of at least 6 characters'
                },
                'new-password2': {
                    required: 'Please re-enter your new password',
                    minlength: 'Your password must consist of at least 6 characters',
                    equalTo: 'Please enter the same password as above'
                }
            }
        });
    };

    var initValidationBootstrap_prefix = function(){
      jQuery( '.js-validation-bootstrap_prefix' ).validate({
          errorClass: 'help-block animated fadeInDown',
          errorElement: 'div',
          errorPlacement: function( error, e ) {
              jQuery(e).parents( '.form-group > div' ).append( error );
          },
          highlight: function(e) {
              jQuery(e).closest( '.form-group' ).removeClass( 'has-error' ).addClass( 'has-error' );
              jQuery(e).closest( '.help-block' ).remove();
          },
          success: function(e) {
              jQuery(e).closest( '.form-group' ).removeClass( 'has-error' );
              jQuery(e).closest( '.help-block' ).remove();
          },
          rules: {
              'txtPrefix': {
                  required: true
              }
          },
          messages: {
              'txtPrefix': {
                  required: 'Please enter prefix'
              }
          }
      });
    };

    var initValidationBootstrap_post = function(){
      jQuery( '.js-validation-bootstrap_post' ).validate({
          errorClass: 'help-block animated fadeInDown',
          errorElement: 'div',
          errorPlacement: function( error, e ) {
              jQuery(e).parents( '.form-group > div' ).append( error );
          },
          highlight: function(e) {
              jQuery(e).closest( '.form-group' ).removeClass( 'has-error' ).addClass( 'has-error' );
              jQuery(e).closest( '.help-block' ).remove();
          },
          success: function(e) {
              jQuery(e).closest( '.form-group' ).removeClass( 'has-error' );
              jQuery(e).closest( '.help-block' ).remove();
          },
          rules: {
              'txtTitle': {
                  required: true
              },
              'txtCategory': {
                  required: true
              }
          },
          messages: {
              'txtPrefix': {
                  required: 'Please enter post title'
              },
              'txtCategory': {
                  required: 'Please select post category'
              }
          }
      });
    };


    return {
        init: function () {
            // Init Bootstrap Forms Validation for change password page
            initValidationBootstrap_changepassword();

            // Init Bootstrap Forms Validation for change password page
            initValidationBootstrap_prefix();

            // Init Bootstrap Forms Validation for post page
            initValidationBootstrap_post();

        }
    };
}();

// Initialize when page loads
jQuery( function() {
	BaseFormValidation.init();
});
