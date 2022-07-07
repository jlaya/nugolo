<?php
    function google_analytics($code=null) {
        $CI = get_instance();
        if ($CI->config->item('analytics_active') == TRUE) {
        # ... despues de haber verificado que hay un código de Analytics, el resto es output
?>