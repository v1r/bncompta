<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//  CI 2.0 Compatibility
if (!class_exists('CI_Model')) {

    class CI_Model extends Model {
        
    }

}

/**
 * 
 *  @author Karim Besbes
 *  @version v0.0.1 
 *  @name KB Entreprise Model 
 *  
 *  Created on 18/06/11
 *  Last Modification : 19/06/11 
 */
class Manager_model extends CI_Model {

    public function get_all_managers() {

        $manager_data = array();
        $this->db->select('id');
        $this->db->where('group_id', 2);
        $manager_list = $this->db->get('users')->result();
        foreach ($manager_list as $key) {
            $manager_data[] = $this->get_manager_name($key->id);
        }
        return $manager_data;
    }

    public function get_manager_name($user_id) {
        return $this->db->select('users_profiles.user_id, users_profiles.first_name, users_profiles.last_name')
                ->from('users')
                ->where('users.id', $user_id)
                ->join('users_profiles', 'users.id = users_profiles.user_id')
                ->get()
                ->row();
    }

}