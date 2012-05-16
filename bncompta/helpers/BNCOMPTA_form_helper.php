<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
// button open
if (!function_exists('form_button')) {

   function form_button($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'text', 'name' => (( ! is_array($data)) ? $data : ''));

		return "<button "._parse_form_attributes($data, $defaults).$extra.">" . $value . "</button>";
	}

}
// ------------------------------------------------------------------------
    /* End of file language_helper.php */
    /* Location: ./system/helpers/language_helper.php */