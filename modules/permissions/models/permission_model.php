<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


/**
 * 
 *  @author Karim Besbes
 *  @version v0.0.1 
 *  @name Permissions model
 *  
 *  Created on 09/06/11
 *  Last Modification : 10/06/11 
 */

class Permission_model extends CI_Model
{
 
    public function get_user_rules($user_id = '') 
    { 
        if(empty($id))
        { 
            $user_id = $this->session->userdata('id') ;
        }
        
        $results = $this->db
                            ->where('user_id',$user_id)
                            ->get('rules')
                            ->result(); 
        
                   
        $user_permissions = array() ; 
		foreach ($results as $row)
		{
		        $module = $this->mods_model->get_module_by_id($row->module_id); 
			$user_permissions[] = array($module->name,$row->controller_name,$row->method_name); 
		}
        
		return $user_permissions ;                   
        
        
    }
}
