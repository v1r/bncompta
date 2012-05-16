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
 *  @version v0.2  
 *  @name KB Authentification Modele 
 */
class Bncompta_auth_model extends CI_Model {

    /**
     * Users Table 
     * @todo We will Put all these informations in a config file 
     */
    private $users_table = 'users';
    private $users_rel_table = 'user_entreprise_rel';
    private $users_roles_table = 'roles';
    private $users_profiles_table = 'users_profiles';
    private $entreprises_table = 'entreprises';

    /**
     * Create a new user account  
     * @author Karim Besbes
     * @return bool 
     */
    public function add_user($username, $password, $email, $user_data, $rules = array()) {
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $this->hashThis($password),
            'group_id' => 3,
            'created_on' => now(),
            'login_attempts' => 0,
            'default_lang' => 'fr'
        );

        if (!$this->db->insert($this->users_table, $data))
            return false;

        $user_id = $this->db->insert_id();
        $data_rel = array(
            'user_id' => $user_id,
            'entreprise_id' => $user_data['entreprise_id'],
            'role_id' => 3
        );
        $data_profil = array(
            'user_id' => $user_id,
            'last_name' => $user_data['last_name'],
            'first_name' => $user_data['first_name']
        );


        if (!$this->db->insert($this->users_rel_table, $data_rel) || !$this->db->insert($this->users_profiles_table, $data_profil)) {
            $this->db->where($user_id)->delete($this->users_table);
        }

        foreach ($rules as $v) {
            list($module_name, $controller_name, $method_name) = explode('|', $v);
            $module_id = $this->mods_model->get_module_id($module_name);
            $m[$module_id][$controller_name][] = $method_name;
        }
        $data_methods = array(
            'user_id' => $user_id,
            'controller_name' => $controller_name,
            'method_name' => $method_name
        );

        foreach ($m as $module_id => $controller_name) {
            foreach ($controller_name as $cname => $methods) {
                $rules_data = array(
                    'user_id' => $user_id,
                    'module_id' => $module_id,
                    'controller_name' => $cname,
                    'methods' => serialize($methods)
                );
                $this->db->insert('rules', $rules_data);
            }
        }

        return true;
    }

    public function update_user($user_id, $username, $password, $email, $user_data, $rules = array()) {
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $this->hashThis($password),
            'group_id' => 3,
            'created_on' => now(),
            'login_attempts' => 0,
            'default_lang' => 'fr'
        );

        $this->db->where($this->users_table . '.id', $user_id)->update($this->users_table, $data);

        $data_rel = array(
            'user_id' => $user_id,
            'entreprise_id' => $user_data['entreprise_id'],
            'role_id' => 3
        );
        $data_profil = array(
            'user_id' => $user_id,
            'last_name' => $user_data['last_name'],
            'first_name' => $user_data['first_name']
        );
        $this->db->where($this->users_rel_table . '.user_id', $user_id)->update($this->users_rel_table, $data_rel);
        $this->db->where($this->users_profiles_table . '.user_id', $user_id)->update($this->users_profiles_table, $data_profil);



        foreach ($rules as $v) {
            list($module_name, $controller_name, $method_name) = explode('|', $v);
            $module_id = $this->mods_model->get_module_id($module_name);
            $m[$module_id][$controller_name][] = $method_name;
        }
        $data_methods = array(
            'user_id' => $user_id,
            'controller_name' => $controller_name,
            'method_name' => $method_name
        );

        foreach ($m as $module_id => $controller_name) {
            foreach ($controller_name as $cname => $methods) {
                $rules_data = array(
                    'user_id' => $user_id,
                    'module_id' => $module_id,
                    'controller_name' => $cname,
                    'methods' => serialize($methods)
                );
                $this->db->where('id', $user_id)->update('rules', $rules_data);
            }
        }

        return true;
    }

    /**
     * Create a new manager account
     * @author Karim Besbes
     * @return bool 
     */
    public function add_manager($username, $password, $email, $user_data) {

        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $this->hashThis($password),
            'group_id' => 2,
            'created_on' => now(),
            'login_attempts' => 0,
            'default_lang' => 'fr'
        );

        if (!$this->db->insert($this->users_table, $data))
            return false;
        $user_id = $this->db->insert_id();
        $data_update = array('manager_id' => $user_id);
        $this->db->where('id', $user_data['entreprise_id'])
                ->update($this->entreprises_table, $data_update);
        $data_rel = array(
            'user_id' => $user_id,
            'entreprise_id' => $user_data['entreprise_id'],
            'role_id' => 2
        );
        $data_profil = array(
            'user_id' => $user_id,
            'last_name' => $user_data['last_name'],
            'first_name' => $user_data['first_name']
        );


        if (!$this->db->insert($this->users_rel_table, $data_rel) || !$this->db->insert($this->users_profiles_table, $data_profil)) {
            $this->db->where($user_id)->delete($this->users_table);
            return false;
        }

        return true;
    }

    /**
     * Get all managers 
     * @return object of array 
     * @author Kairm Besbes
     */
    public function get_all_managers($filter) {

        $this->db->select()->from($this->users_table);
        $this->db->join($this->users_profiles_table, $this->users_profiles_table . '.user_id = ' . $this->users_table . '.id', 'left');

        if (!empty($filter['group'])) {
            $this->db->where('group_id', $filter['group']);
        } else {
            $this->db->where($this->users_table . '.group_id != ', 1);
        }
        if (!empty($filter['entreprise'])) {
            $this->db->join($this->users_rel_table, $this->users_rel_table . '.user_id = ' . $this->users_table . '.id', 'left');
            $this->db->where('entreprise_id', $filter['entreprise']);
        }
        $this->db->order_by('users.created_on', 'asc');
        return $this->db->get()->result();
    }

    public function get_all_users($entreprise_id = '') {
        $this->db->select();
        $this->db->from($this->users_table);
        $this->db->from($this->users_rel_table);
        $this->db->from($this->users_profiles_table);
        $this->db->where('users.id = users_profiles.user_id and users.id = user_entreprise_rel.user_id');
        if (!empty($entreprise_id)) {
            $this->db->where('user_entreprise_rel.entreprise_id', $entreprise_id);
            $this->db->where('users.group_id', 3);
        }
        $this->db->join('roles', 'user_entreprise_rel.role_id = roles.id', 'left');
        $this->db->order_by('users.group_id', 'asc');
        return $this->db->get()->result();
    }

    /**
     * Simple function to hash password (Hashing method : SHA1)
     * @return string
     * @author Karim Besbes
     */
    public function hashThis($password) {
        return (empty($password) ? false : sha1($password));
    }

    /**
     * We check if the user login exist or not
     * @author Kairm Besbes
     * @return bool 
     */
    public function login_exist($login = '') {
        $username_exist = false;
        $email_exist = false;

        if (empty($login)) {
            return false;
        } else {
            if ($this->db->where('username', $login)->count_all_results($this->users_table) > 0) {
                $username_exist = true;
            }
            if ($this->db->where('email', $login)->count_all_results($this->users_table) > 0) {
                $email_exist = true;
            }
        }
        if ($username_exist == true || $email_exist == true)
            return true;
        else
            return false;
    }

    /**
     * Get user id by email/username
     * @author Karim Besbes
     * @return bool 
     */
    public function get_user_id($login = '') {
        if (empty($login)) {
            return;
        } else {
            if ($user_id = $this->db->select('id')->from('users')->where('username', $login)->get()->row('id'))
                return $user_id;
            else if ($user_id = $this->db->select('id')->from('users')->where('email', $login)->get()->row('id'))
                return $user_id;
            else
                return false;
        }
    }

    /**
     * Try to authentificate user and set his session data
     * @author Karim Besbes
     * @return bool 
     */
    private function try_auth($user_id, $password) {

        $result = $this->get_user_data($user_id);
        $password_data = $result->password;
        if (!empty($password_data) && $this->check_password($password_data, $password)) {
            $last_login = $this->get_last_login_time($user_id);
            $this->set_user_data($result, $last_login);
            $this->set_last_login_time($user_id);
            return true;
        } else {
            return false;
        }
    }

    public function get_last_login_time($user_id) {
        $result = $this->db->select('last_login')->get_where('users', array('id' => $user_id))->row();
        if (!$result->last_login)
            return now();
        else
            return $result->last_login;
    }

    public function set_last_login_time($user_id) {
        $data = array(
            'last_login' => now()
        );
        return $this->db
                        ->where('id', $user_id)
                        ->update('users', $data);
    }

    /**
     * Authentification 
     * @author Karim Besbes
     * @return void 
     */
    public function authentificate($user_id, $password) {
        if (empty($user_id) || empty($password)) {
            return FALSE;
        } else {
            if ($this->try_auth($user_id, $password)) {
                return true;
            }
            else
                return false;
        }
    }

    /**
     * We check if the user typed the correct password
     * @author Karim Besbes
     * @return bool 
     */
    private function check_password($password, $given_password) {
        if ($password === $this->hashThis($given_password)) {
            return true;
        }
        else
            return false;
    }

    /**
     *  Get user data 
     *  @author Karim Besbes
     *  @return array 
     */
    public function get_user_data($user_id = '') {
        if (empty($user_id)) {
            $user_id = $this->session->userdata('id');
        }
        $this->db->select()
                ->from($this->users_table)
                ->join('groups', $this->users_table . '.group_id = ' . 'groups.id', 'left')
                ->join($this->users_roles_table, $this->users_table . '.group_id = ' . $this->users_roles_table . '.id', 'left')
                ->join($this->users_profiles_table, $this->users_profiles_table . '.user_id = ' . $this->users_table . '.id', 'left')
                ->where($this->users_table . '.id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            return $query->row();
        }
        else
            return;
    }

    /**
     * Set user data
     * @author Karim Besbes
     * @return void 
     */
    protected function set_user_data($data = array(), $last_login) {
        $this->session->set_userdata('id', $data->user_id);
        $this->session->set_userdata('username', $data->username);
        $this->session->set_userdata('email', $data->email);
         $this->session->set_userdata('interface', $data->interface);
        $this->session->set_userdata('group_id', $data->group_id);
        $this->session->set_userdata('entreprise_id', '');
        $this->session->set_userdata('last_login', $last_login);
        $this->session->set_userdata('modules', $this->mods_model->get_all_modules());
        $this->session->set_userdata('user_rules', $this->permission_model->get_user_rules());
    
    }

    /**
     * UnSet user data
     * @author Karim Besbes
     * @return void 
     */
    public function unset_user_data($data = array()) {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('group_id');
        $this->session->unset_userdata('last_login');
        $this->session->unset_userdata('entreprise_id');
        $this->session->unset_userdata('modules');
        $this->session->unset_userdata('user_rules');
    }

    public function switch_permission($from_user_id, $to_user_id) {

        $result = $this->get_user_data($to_user_id);
        $last_login = $this->get_last_login_time($to_user_id);
        $this->set_ghost_permission_data($result, $last_login, $from_user_id);
        return true;
    }

    public function set_ghost_permission_data($data = array(), $last_login, $from_user_id) {
        $this->session->set_userdata('id', $data->user_id);
        $this->session->set_userdata('username', $data->username);
        $this->session->set_userdata('email', $data->email);
        $this->session->set_userdata('group_id', $data->group_id);
        $this->session->set_userdata('last_login', $last_login);
        $this->session->set_userdata('entreprise_id', '');
        $this->session->set_userdata('ghost_permission', $from_user_id);
        $this->session->sess_write();
    }

    public function restore_permission($to_user_id) {

        $result = $this->get_user_data($to_user_id);
        $last_login = $this->get_last_login_time($to_user_id);
        $this->restore_ghost_permission_data($result, $last_login);
        return true;
    }

    public function restore_ghost_permission_data($data = array(), $last_login) {
        $this->session->set_userdata('id', $data->user_id);
        $this->session->set_userdata('username', $data->username);
        $this->session->set_userdata('email', $data->email);
        $this->session->set_userdata('group_id', $data->group_id);
        $this->session->set_userdata('last_login', $last_login);
        $this->session->set_userdata('last_login', '');
        $this->session->unset_userdata('ghost_permission');
        $this->session->sess_write();
    }

}

