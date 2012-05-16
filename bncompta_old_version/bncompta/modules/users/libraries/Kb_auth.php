<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @Name KB Auth
 * @Author: Karim Besbes - contact@karimbesbes.com      
 * @Package BNCompta
 * @version V0.2 
 * @Catergory Users Authentification  
 *  
 */
class Kb_auth {

    /**
     * CodeIgniter global
     * @var string
     * */
    protected $ci;

    /**
     * construct
     * @return void
     * @author Karim Besbes
     * */
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
        $this->ci->load->helper('cookie');
        $this->ci->load->model('users/kb_auth_model');
    }

    /**
     * Create user 
     * @author Karim Besbes
     * @return void
     * 
     * */
    public function add($username, $password, $email, $data_array, $type, $rules = array()) {
        // If type equal to 2 then it's a manager else it's a simple user 
        if ($type == 2) {
            if ($this->ci->kb_auth_model->add_manager($username, $password, $email, $data_array)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if ($this->ci->kb_auth_model->add_user($username, $password, $email, $data_array, $rules)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * Authentificate user
     * @author Karim Besbes
     * @return bool 
     */
    public function authentificate($login, $password) {
        if ($this->ci->kb_auth_model->login_exist($login)) {
            $user_id = $this->ci->kb_auth_model->get_user_id($login);
            if ($this->ci->kb_auth_model->authentificate($user_id, $password)) {
                return true;
            }
            else
                return false;
        }
        else
            return false;
    }

    /**
     * Check if the user is already logged in 
     * @author Karim Besbes
     * @return bool 
     */
    public function already_logged_in() {
        return (bool) $this->ci->session->userdata('email');
    }

    /**
     * Test user permission
     * @author Karim Besbes
     */
    public function ghost_permission($to_user_id) {
        return $this->ci->kb_auth_model->switch_permission($this->ci->session->userdata('id'), $to_user_id);
    }

    /**
     * Restore ghost permission
     * @author Karim Besbes
     */
    public function restore_ghost_permission($to_user_id) {
        return $this->ci->kb_auth_model->restore_permission($to_user_id);
    }

    /**
     * Logout 
     * @author Karim Besbes
     * @return void 
     */
    public function logout() {
        $this->ci->kb_auth_model->unset_user_data();
        $this->ci->session->sess_destroy();
    }

    /**
     * @author Karim Besbes
     * @return array of objects
     */
    public function get_user_data() {
        return $this->ci->kb_auth_model->get_user_data();
    }

}