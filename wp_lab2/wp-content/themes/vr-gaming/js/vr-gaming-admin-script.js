( function( jQuery ){
    jQuery( document ).ready( function(){
      jQuery( '.vr-gaming-btn-get-started' ).on( 'click', function( e ) {
          e.preventDefault();
          jQuery( this ).html( 'Processing.. Please wait' ).addClass( 'updating-message' );
          jQuery.post( vr_gaming_ajax_object.ajax_url, { 'action' : 'install_act_plugin' }, function( response ){
              location.href = 'customize.php?vr_gaming_notice=dismiss-get-started';
          } );
      } );
    } );

    jQuery(document).ready(function ($) {
        // Notice dismiss
        $(document).on('click', '.notice-get-started-class .notice-dismiss', function () {
            var type = $(this).closest('.notice-get-started-class').data('notice');
            $.ajax({
                type: 'POST',
                url: vr_gaming_ajax_object.ajax_url,
                data: {
                    action: 'vr_gaming_dismissed_notice_handler',
                    type: type,
                    nonce: vr_gaming_ajax_object.dismiss_nonce
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Notice dismissed');
                    }
                }
            });
        });
    });
}( jQuery ) )
