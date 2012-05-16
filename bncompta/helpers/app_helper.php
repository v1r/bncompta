<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

/**
 * Array Helpers
 *
 * @package		CodeIgniter
 * @category 	Helpers
 * @author      Karim Besbes
 */
function getParentStack($child, $stack) {
    $result = array();
    foreach ($stack as $k => $v) {
        if (is_array($v)) {
            // If the current element of the array is an array, recurse it and capture the return
            $return = getParentStack($child, $v);

            // If the return is an array, stack it and return it
            if (is_array($return)) {
                return array($k => $return);
            }
        } else {
            // Since we are not on an array, compare directly
            if ($v == $child) {
                // And if we match, stack it and return it
                $result = array(array($k => $child));
            }
        }
    }
    if (in_array(array('found'), $result))
        return true;
    else
        return false;
}
 
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
/**
 *
 *  @author Karim BESBES
 *  @package BNCOMPTA
 */
/* --------------------------------------------------------------
  |
  | Template helper
 */
if (!function_exists('disable_layout_on_ajax')) {

    /**
     * Function to detect if we are dealing with 
     * @return type 
     */
    function disable_layout_on_ajax() {
        $CI = & get_instance();
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $CI->template->set_layout(FALSE);
        }
    }

}

/* --------------------------------------------------------------
  |
  | HTTP Requests helper
 */

if (!function_exists('ajax_request')) {

    /**
     * Function to detect if we are dealing with 
     * @return type 
     */
    function ajax_request() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

}

if (!function_exists('post_request')) {

    /**
     * Post request 
     * @param type $index
     * @param type $xss_clean
     * @return type 
     */
    function post_request($index = NULL, $xss_clean = FALSE) {
        $CI = & get_instance();
        return $CI->input->post($index, $xss_clean);
    }

}

/**
 *
 * @package		AIMS
 * @author		AIMS DEV TEAM 
 */
if (!function_exists('any_request')) {

    /**
     * Get any http request
     * @param type $index
     * @param type $xss_clean
     * @return type 
     */
    function any_request($index = NULL, $xss_clean = FALSE) {
        $CI = & get_instance();
        return $CI->input->get_post($index, $xss_clean);
    }

}

/* --------------------------------------------------------------
  |
  | Assets helper
 */
if (!function_exists('get_js_lib_path')) {

    /**
     * Function to load a javascript library 
     * @param string $lib
     * @return type 
     */
    function get_js_lib_path($lib, $dir = FALSE) {

        if (!$dir) {
            $lib = $lib . '/' . $lib . '-min.js';
            return JS_LIBS_FOLDER_PATH . $lib;
        }
        else
            return JS_LIBS_FOLDER_PATH . $lib;
    }

}


if (!function_exists('get_js_path')) {

    /**
     * Returns javascript path folder
     * @return string 
     */
    function get_js_path() {


        return JS_FOLDER_PATH;
    }

}
if (!function_exists('script_tag')) {

    /**
     * Genere template script tag type="text/template"
     * @param type $tag
     * @param type $type
     * @param type $id
     * @return string 
     */
    function script_tag($tag, $type = FALSE, $id = FALSE) {
        if ($tag == 'open')
            return '<script type="text/' . $type . '" id="' . $id . '">';
        else if ($tag == 'close')
            return "</script>";
    }

}

/* --------------------------------------------------------------
  |
  |    Debug helper
 */
if (!function_exists('dump')) {

    /**
     * Debug Helper
     * 
     * Outputs the given variable(s) with formatting and location
     * @credit  Phil Sturgeon
     * @access        public
     * @param        mixed    variables to be output
     */
    function dump() {
        list($callee) = debug_backtrace();
        $arguments = func_get_args();
        $total_arguments = count($arguments);

        echo '<fieldset style="z-index:20000 ;position:relative ;background: #fefefe !important; border:2px red solid; padding:5px;font-size:12px;">';
        echo '<legend style="background:lightgrey; padding:5px;">' . $callee['file'] . ' @ line: ' . $callee['line'] . '</legend><pre>';
        $i = 0;
        foreach ($arguments as $argument) {
            echo '<br/><strong>Debug #' . (++$i) . ' of ' . $total_arguments . '</strong>: ';
            var_dump($argument);
        }

        echo "</pre>";
        echo "</fieldset>";
    }

}
if (!function_exists('config')) {

    /**
     * Function to detect if we are dealing with 
     * @return type 
     */
    function config($param, $index = '') {
        $CI = & get_instance();
        return $CI->config->item($param, $index);
    }

}
if (!function_exists('set_language')) {

    /**
     * Function to detect if we are dealing with 
     * @return type 
     */
    function set_language($code) {
        $_SESSION['lang_code'] = $code;
    }

}
?>