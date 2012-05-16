<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

/**
 * @author Karim Besbes
 * Function to detect ajax request
 */
function is_ajax() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
        return true;
    }
    else
        return false;
}

?>
