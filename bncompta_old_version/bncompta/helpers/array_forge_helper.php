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
 *
 * @param type $array 
 * @author Karim Besbes
 */
/** later **/ 
/**
function is_defined_array($array) {
    $sum = 0 ;
    $num_row = count($array) ;
    for($i=0 ; $i<$num_row ; $i++)
    {
        if (!isset($array[$i]))
        {
            echo $array[$i]; 
            $sum++; 
        }
    }
    (count($array) == $sum)? TRUE : FALSE ;
}
**/
?>