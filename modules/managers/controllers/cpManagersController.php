<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users management controller 
 * 
 * @author Karim Besbes - BNCompta dev team
 * @package BNCompta 
 * @subpackage Admin module 
 * @copyright	Copyright (c) 2011 2012 
 * @category Modules
 * @since Version 0.2
 * 
 * */
class cpManagersController extends CP_Controller {

    /**
     * Constructor 
     * @return void
     * */
    function __construct() {
        parent::__construct();
 
        $this->config->load('form_validation');
 
        (is_ajax()) ? $this->template->set_layout(FALSE) : '';
        $this->template->set_partial('navigation', 'tpl/navigation_view');
    }

    public function index() {

        $filter['group'] = $this->input->post('filter_by_group');
        $filter['entreprise'] = $this->input->post('filter_by_entreprise');
        $manager_data = new ArrayObject($this->bncompta_auth_model->get_all_managers($filter), ArrayObject::ARRAY_AS_PROPS);
        $this->data->manager_data = $manager_data;
        $this->template->set_partial('filters', 'tpl/filters');
        $this->template->build('tpl/manager_list', $this->data);
    }

    public function users() {
        $user_list = new ArrayObject($this->bncompta_auth_model->get_all_users(), ArrayObject::ARRAY_AS_PROPS);
        foreach ($user_list as $key) {
            $users_data[$key->entreprise_id][$key->id] = $key;
        }
        $this->data->users_data = $users_data;
        $this->template->build('tpl/system_users_view', $this->data);
    }

    public function add($entreprise_label = '') {
        // Get the entreprise id by label 
        $entreprise_id = $this->entreprise_model->get_entreprise_id($entreprise_label);

        // Get manager id 
        $manager_id = $this->entreprise_model->get_entreprise_manager($entreprise_id->id);

        // we check data  
        if (empty($entreprise_id)) {
            $this->session->set_flashdata('error', lang('error_entreprise_not_exist'));
            redirect('managers/manage');
            exit;
        }
        if (!empty($manager_id)) {
            $this->session->set_flashdata('error', lang('error_entreprise_has_manager'));
            redirect('managers/manage');
        }




        // We try to add the user 
        if ($this->form_validation->run('add_manager') !== FALSE) {
            // Get post values 
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'entreprise_id' => $entreprise_id->id
            );
            if ($this->bncompta_auth->add($username, $password, $email, $user_data, $type = 2)) {
                // Flash success
                $this->session->set_flashdata('success', lang('success_user_add'));
                redirect('managers/manage');
            }
            else
                $this->session->flashdata('error', 'erreur');
        }
        else {
            foreach ($this->config->item('add_manager') as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
            $this->data->repopulate = & $repopulate;
        }
        $this->session->flashdata('success', 'ajout avec sucee');
        $this->template->build('tpl/add_manager_form', $this->data);
    }

    /**
     * Check if the email already exist
     * @return bool
     * @author Karim Besbes
     * */
    function _check_email($email) {
        if ($this->bncompta_auth_model->login_exist($email)) {
            $this->form_validation->set_message('_check_email', $this->lang->line('error_email_already_exist'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Check if the email already exist
     * @return bool
     * @author Karim Besbes
     * */
    function _check_username($username) {
        if ($this->bncompta_auth_model->login_exist($username)) {
            $this->form_validation->set_message('_check_username', $this->lang->line('error_username_already_exist'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

}