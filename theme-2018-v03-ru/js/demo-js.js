jQuery('#frame_controls .device_item').click(function(){
            jQuery(this).siblings().removeClass('device_current');
            jQuery(this).addClass('device_current');
            var className = jQuery(this).data('device');
            jQuery('#showframe').attr('class', className);
            return false;
        });