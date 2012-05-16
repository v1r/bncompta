<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * File Uploading Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Uploads
 * @author		ExpressionEngine Dev Team, corrected by Kristian Feldsam
 * @link		http://codeigniter.com/user_guide/libraries/file_uploading.html
 */
class MY_Upload extends CI_Upload {
	
	/**
	 * Verify that the filetype is allowed
	 *
	 * @access	public
	 * @return	bool
	 */	
	function is_allowed_filetype()
	{
		if (count($this->allowed_types) == 0 OR ! is_array($this->allowed_types))
		{
			$this->set_error('upload_no_file_types');
			return FALSE;
		}

		$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe');

		foreach ($this->allowed_types as $val)
		{
			$mime = $this->mimes_types(strtolower($val));

			// Images get some additional checks
			if (in_array($val, $image_types) && $this->is_image())
			{
				if (getimagesize($this->file_temp) === FALSE)
				{
					return FALSE;
				}
			}

			if (is_array($mime))
			{
				if (in_array($this->file_type, $mime, TRUE))
				{
					return TRUE;
				}
			}
			else
			{
				if ($mime == $this->file_type)
				{
					return TRUE;
				}	
			}		
		}
		
		return FALSE;
	}

	// --------------------------------------------------------------------

}
// END Upload Class

/* End of file MY_Upload.php */
/* Location: ./system/application/libraries/MY_Upload.php */