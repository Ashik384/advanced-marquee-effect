/**
 * Admin JavaScript for Advanced Marquee Effect
 */
(function($) {
    'use strict';

    $(function() {
        // Handle notice dismissal click event for the GatePass promotion notice
        $(document).on('click', '#ame-gatepass-promo-notice .notice-dismiss', function() {
            if (typeof ameGatePassPromo === 'undefined') {
                return;
            }

            $.ajax({
                url: ameGatePassPromo.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: ameGatePassPromo.action,
                    nonce: ameGatePassPromo.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Notice successfully dismissed on the server
                    }
                },
                error: function(xhr, status, error) {
                    // Fail silently to avoid breaking the admin layout
                }
            });
        });
    });
})(jQuery);
