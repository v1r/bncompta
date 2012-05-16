<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users management controller 
 * 
 * @author Karim Besbes - BNCompta dev team
 * @package BNCompta 
 * @subpackage Users module
 * @copyright	Copyright (c) 2011, BNCompta
 * @category Modules
 * @since Version 0.1
 * @created on  05/06/2011
 * @last modification on 23/08/2011
 * */
class Manage extends Backend {

    /**
     * Constructor 
     * @return void
     * */
    function __construct() {
        parent::__construct();
 
        $this->template->set_partial('navigation', 'tpl/navigation_view');
    }

    public function index() {
        $this->template->set_partial('filters', 'tpl/filters');
        $entreprise_id = $this->session->userdata('entreprise_id');
        if (!$this->entreprise_model->user_has_access($this->logged_in_user->user_id, $entreprise_id)) {
            redirect('dashboard');
            exit();
        }
        $users_data = $this->bncompta_auth_model->get_all_users($entreprise_id);

        $this->data->users_data = $users_data;
        $this->template->build('tpl/users_list');
    }

    public function add() {
        $entreprise_id = $this->session->userdata('entreprise_id');
        if (!$this->entreprise_model->user_has_access($this->logged_in_user->user_id, $entreprise_id)) {
            redirect('dashboard');
            exit();
        }

        // Get modules id 
        $entreprise_modules = $this->entreprise_model->get_entreprise_modules_by_id($entreprise_id);
        // Get entreprise modules data by id
        $entreprise_modules = unserialize($entreprise_modules);
        foreach ($entreprise_modules as $key) {
            $data[] = $this->mods_model->get_module_by_id($key);
        }
        foreach ($data as $key) {

            $controller_data[$key->name] = unserialize($key->controllers);
        }

        foreach ($controller_data as $key => $val) {
            foreach ($val as $att) {
                $this->data->methods[$key][] = $att;
            }
        }

        // We try to add the user 
        if ($this->form_validation->run('add_user') !== FALSE) {

            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'entreprise_id' => $entreprise_id
            );

            $rules = $this->input->post('methods');
            if ($this->bncompta_auth->add($username, $password, $email, $user_data, $type = '', $rules)) {
                // Flash success
                $this->session->set_flashdata('success', lang('success_user_add'));
                redirect('users/manage');
            }
            else
                $this->session->flashdata('error', 'erreur');
        }
        else {
            foreach ($this->config->item('add_user') as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
            $this->data->repopulate = & $repopulate;
        }
        $this->session->flashdata('success', 'ajout avec sucee');
        $this->template->build('tpl/add_user_form', $this->data);
    }

    public function edit($user_id) {

        // Get modules id 
        $entreprise_id = $this->current_entreprise;
        $entreprise_modules = $this->entreprise_model->get_entreprise_modules_by_id($entreprise_id);
        // Get entreprise modules data by id
        $entreprise_modules = unserialize($entreprise_modules);
        foreach ($entreprise_modules as $key) {
            $data[] = $this->mods_model->get_module_by_id($key);
        }
        foreach ($data as $key) {

            $controller_data[$key->name] = unserialize($key->controllers);
        }

        foreach ($controller_data as $key => $val) {
            foreach ($val as $att) {
                $this->data->methods[$key][] = $att;
            }
        }
        if ($_POST) {
            // We try to add the user 
            if ($this->form_validation->run('add_user') !== FALSE) {

                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $user_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'entreprise_id' => $entreprise_id
                );

                $rules = $this->input->post('methods');
                if ($this->bncompta_auth_model->update_user($user_id, $username, $password, $email, $user_data, $type = '', $rules)) {
                    // Flash success
                    $this->session->set_flashdata('success', lang('success_user_update'));
                    redirect('users/manage');
                }
                else
                    $this->session->flashdata('error', 'erreur');
            }
            else {
                foreach ($this->config->item('add_user') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
            }
        } else {
            $repopulate = $this->bncompta_auth_model->get_user_data($user_id);
            $this->data->repopulate = $repopulate;
        }

        $this->template->build('tpl/edit_user_form', $this->data);
    }

    /**
     * Check if the email already exist
     * @return bool
     * @author Karim Besbes
     *
     */
    function _check_email($email) {
        if ($this->uri->segment(3) == 'edit') {
            // Todo: Find a way to check other emails 
            return true;
        }

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
     *
     */
    function _check_username($username) {
        if ($this->uri->segment(3) == 'edit') {
            // Todo: Find a way to check other emails 
            return true;
        }
        if ($this->bncompta_auth_model->login_exist($username)) {
            $this->form_validation->set_message('_check_username', $this->lang->line('error_username_already_exist'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

?>