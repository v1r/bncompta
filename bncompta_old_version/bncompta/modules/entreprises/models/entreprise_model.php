<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!class_exists('CI_Model')) {

    class CI_Model extends Model {
        
    }

}

/**
 * 
 *  @author Karim Besbes
 *  @version v0.1 
 *  @name Entreprise Model 
 *  
 *  Created on 18/06/11
 *  Last Modification : 19/07/04 
 */
class Entreprise_model extends CI_Model {

    public function get_entreprise_id($entreprise_label = '') {
        return $this->db->select('id')->where('label', $entreprise_label)->get('entreprises')->row();
    }

    public function get_all_entreprises() {
        return $this->db->select()
                ->from('entreprises')
                ->join('entreprises_profiles', 'entreprises.current_profile_id = entreprises_profiles.id', 'left')
                ->order_by('entreprises.created_on', 'asc')
                ->get()
                ->result();
    }

    public function get_user_entreprise($user_id) {
        return $this->db->where('user_id', $user_id)->get('user_entreprise_rel')->row()->entreprise_id;
    }

    public function get_entreprise_manager($entreprise_id) {
        return $this->db->get_where('user_entreprise_rel', array('entreprise_id' => $entreprise_id))->result();
    }

    public function get_entreprise_modules() {
        return $this->db->select('id,name')->get_where('modules', array('type' => 'mod_entreprise'))->result();
    }

    public function get_entreprise_modules_by_id($entreprise_id) {
        $this->db->select('entreprises_modules.modules');
        $this->db->from('entreprises_modules')->from('modules');
        $this->db->where('entreprises_modules.entreprise_id', $entreprise_id);
        return $this->db->get()->row()->modules;
    }

    public function get_manager_entreprises($manager_id) {

        return $this->db->select()
                ->from('entreprises')
                ->join('entreprises_profiles', 'entreprises.current_profile_id = entreprises_profiles.id', 'left')
                ->where('entreprises.manager_id', $manager_id)
                ->get()
                ->result();
    }

    public function remove_entreprise_manager($entreprise_id) {
        $this->db->delete('user_entreprise_rel', array('entreprise_id' => $entreprise_id, 'role_id' => 2));
        $this->db->update('entreprises', array('manager_id' => 0 ));
        return true; 
    }

    public function assign_mananger($entreprise_id, $manager_id) {

        if ($manager_id == 'none') {
            $this->remove_entreprise_manager($entreprise_id); 
        } else {
            $this->db->where('id', $entreprise_id)->update('entreprises', array('manager_id' => $manager_id));
            $data = array('user_id' => $manager_id, 'entreprise_id' => $entreprise_id, 'role_id' => 2);
            $this->db->insert('user_entreprise_rel', $data);
        }
    }

    public function add_entreprise($label, $name, $email, $description, $modules) {

        $data = array(
            'label' => $label,
            'created_on' => now()
        );
        $this->db->insert('entreprises', $data);
        $entreprise_id = $this->db->insert_id();
        $data = array(
            'entreprise_id' => $entreprise_id,
            'name' => $name,
            'description' => $description,
            'email' => $email,
            'created_on' => now(),
            'updated_on' => now()
        );

        $this->db->insert('entreprises_profiles', $data);
        $profile_id = $this->db->insert_id();
        $data = array('current_profile_id' => $profile_id);
        $this->db->where('id', $entreprise_id)
                ->update('entreprises', $data);
        $this->db->insert('entreprises_modules', array('entreprise_id' => $entreprise_id, 'modules' => serialize($modules)));
        return true;
    }

    public function update_entreprise($data, $entreprise_id) {
        $entreprise_data = array(
            'label' => $data['label'],
        );

        $entreprise_profiles = array(
            'description' => $data['description'],
            'email' => $data['email'],
            'name' => $data['name'],
        );

        $entreprise_modules = array(
            'modules' => serialize($data['modules']),
        );
        $this->db->where('id', $entreprise_id)->update('entreprises', $entreprise_data);
        $this->db->where('entreprise_id', $entreprise_id)->update('entreprises_profiles', $entreprise_profiles);
        $this->db->where('entreprise_id', $entreprise_id)->update('entreprises_modules ', $entreprise_modules);
        return true;
    }

    public function get_entreprise_data($entreprise_id) {
        $this->db->select();
        $this->db->from('entreprises')->from('entreprises_profiles');
        $this->db->where('entreprises.id', $entreprise_id);
        $this->db->where('entreprises_profiles.entreprise_id = entreprises.id', NULL);
        return $this->db->get()->result();
    }

    public function update_entreprise_permissions($entreprise_id, $modules) {

        $this->db->delete('entreprises_modules', array('entreprise_id' => $entreprise_id));
        for ($count = 0; $count < sizeof($modules); $count++)
            $this->db->insert('entreprises_modules', array('entreprise_id' => $entreprise_id, 'module_id' => $modules[$count]));
        return true;
    }

    public function user_has_access($user_id, $entreprise_id) {
        return (bool) $this->db
                ->get_where('user_entreprise_rel', array('user_id' => $user_id, 'entreprise_id' => $entreprise_id))
                ->row();
    }

}