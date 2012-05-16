<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!class_exists('CI_Model')) {

    class CI_Model extends Model {
        
    }

}

/**
 *  @author Karim Besbes
 *  @version v0.1 
 *  @name Profil model
 *  
 *  Created on 11/07/15 
 *  Last Modification : 11/07/15 
 */
class Profil_model extends CI_Model {

    public function get_profil_informations($user_id) {
        return $this->db->select()
                ->join('users', 'users_profiles.user_id = users.id', 'left')
                ->get_where('users_profiles', array('user_id' => $user_id))
                ->row();
    }

    public function update_account_detail($user_id, $username, $email, $password) {
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' =>  sha1($password)

        );
        return $this->db->where('id', $user_id)->update('users', $data);
    }

    public function update_personnel_information($user_id, $first_name, $last_name, $address, $post_code, $position) {
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address,
            'post_code' => $post_code,
            'position' => $position
        );
        return $this->db->where('user_id', $user_id)->update('users_profiles', $data);
    }

    public function update_contact_information($user_id, $mobile_number, $office_number, $home_number, $fax_number) {
        $data = array(
            'mobile_number' => $mobile_number,
            'office_number' => $office_number,
            'home_number' => $home_number,
            'fax_number' => $fax_number
        );
        return $this->db->where('user_id', $user_id)->update('users_profiles', $data);
    }

    public function update_social_information($user_id, $gravatar, $msn, $yahoo, $gmail, $twitter, $facebook) {
        $data = array(
            'gravatar' => $gravatar,
            'msn' => $msn,
            'yahoo' => $yahoo,
            'gmail' => $gmail,
            'twitter' => $twitter,
            'facebook' => $facebook
        );
        return $this->db->where('user_id', $user_id)->update('users_profiles', $data);
    }

}
