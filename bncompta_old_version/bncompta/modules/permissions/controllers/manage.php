<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users management controller 
 * 
 * @author Karim Besbes - BNCompta dev team
 * @package BNCompta 
 * @subpackage Permissions Module
 * @copyright	Copyright (c) 2011, BNCompta
 * @since Version 0.1
 * @created on  18/07/2011
 * @modified on 18/07/2011
 * */
class Manage extends Backend {

    /**
     * Constructor 
     * @return void
     * */
    function __construct() {
        parent::__construct();
        $this->lang->load('permissions');
    }

    public function index() {
        $entreprises_data = new ArrayObject($this->entreprise_model->get_all_entreprises(), ArrayObject::ARRAY_AS_PROPS);
        $availble_managers = $this->manager_model->get_all_managers();
        $manager_name = array();

        // Let's get the manager name 

        foreach ($entreprises_data as $key) {
            if ($key->manager_id != 0) {
                $manager_name[$key->id] = $this->manager_model->get_manager_name($key->manager_id);
            }
        }
        //dump($manager_name);
        $available_managers = $this->manager_model->get_all_managers();
        $this->data->entreprises_data = $entreprises_data;
        $this->data->manager_name = $manager_name;
        $this->template->build('tpl/permissions_view');
    }

    public function entreprises($id_entreprise) {

        $this->data->mod_entreprise = $this->entreprise_model->get_entreprise_modules();

        $entreprise_permissions = $this->entreprise_model->get_entreprise_modules_by_id($id_entreprise);
        $list_of_permissions = array();
        foreach ($entreprise_permissions as $k1) {
            $list_of_permissions[$k1->module_id] = $k1->module_id;
        }
        $this->data->entreprise_permissions = $list_of_permissions;
        $this->load->view('permissions/tpl/permissions_entreprises_ajax_form', $this->data);
    }

    public function ajax_update_permissions($entreprise_id) {
         
            $modules = $this->input->post('modules');
            $this->entreprise_model->update_entreprise_permissions($entreprise_id, $modules);
    
    }

    /**
     * Switch ghost permission
     */
    public function switch_permission_mode($to_user_id) {
        if (!$this->session->userdata('ghost_permission')) {
            if ($this->kb_auth->ghost_permission($to_user_id)) {

                $this->session->set_flashdata('success', lang('common.ghost_permission_message'));
                redirect('dashboard');
            }
        }
        else
            redirect('dashboard');
    }

    /**
     * Resotre permission
     */
    public function restore_permission() {
        if ($this->kb_auth->restore_ghost_permission($this->session->userdata('ghost_permission'))) {
            $this->session->set_flashdata('success', lang('common.ghost_permission_restored_label'));
            redirect('dashboard');
        }
        else if(!$this->session->userdata('ghost_permission'))
        redirect('dashboard');
    }

}

?>