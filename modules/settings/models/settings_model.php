<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


/**
 * 
 *  @author Karim Besbes
 *  @version v0.1 
 *  @name Permissions model
 *  
 *  Created on 11/07/12
 *  Last Modification : 11/07/12
 */

class Settings_model extends CI_Model
{

    /**
     * @author Karim Besbes
     * @return string 
     */
    
    public function get_setting_value($name)
    { 
       
        return $this->db->get_where('settings', array('option_name' => $name))->row()->option_value; 
       
    }
    
    public function set_setting_value($name, $value)
    { 
      $data = array('option_value' => $value); 
      return $this->db->where('option_name',$name)->update('settings', $data); 
    }
  
}
