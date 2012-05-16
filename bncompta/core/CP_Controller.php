<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CP_Controller extends BNCOMPTA_Controller {

    public $ignored_segments = array('dashboard/home', 'dashboard/entreprise', 'dashboard/settings', 'dashboard/profil');
    public $current_entreprise;

    function __construct() {

        parent::__construct();
       
        $this->lang->load('common');
        $this->load->model('managers/manager_model');
        $this->load->model('entreprises/entreprise_model');



        if (!isset($this->logged_in_user)) {
            redirect('auth/login');
            exit;
        }
 
        if (!self::_check_access()) {
            show_error('Ouups !! tu n\'a pas les permissions necessaire pour acceder a ces donnees');
            exit;
        }

        $module_title_description = array();
        $module_description = array();
        $this->current_entreprise = $this->session->userdata('entreprise_id');
        // Get the module title and description 
        
        foreach ($this->module_data as $module_name => $attribute) {
          dump($this->module_data[$module_name]->description);
            $module_title_description[$module_name] = unserialize($this->module_data[$module_name]->title);
            $module_description[$module_name] = unserialize($this->module_data[$module_name]->description);
            $this->module_data[$module_name]->title = unserialize($this->module_data[$module_name]->title);
            $this->module_data[$module_name]->description = unserialize($this->module_data[$module_name]->description);
        }

        $this->data->module_title_description = $module_title_description;

        $this->data->module_description = $module_description;
        // Get module methods 

        foreach ($this->module_data as $module_name => $values) {
            $this->controller_data[$module_name] = unserialize($this->module_data->$module_name->class_data);
            $module_name_by_id[$values->id] = $values->name;
        }

        $this->data->module_name_by_id = $module_name_by_id;

        $this->data->controller_data = $this->controller_data;
        // Get the full name 
        $this->data->full_name = $this->logged_in_user->first_name . ' ' . $this->logged_in_user->last_name;

        // Grab all the user data
        $this->data->user_information = $this->logged_in_user;

        // Grab modules data
        $this->data->modules = $this->module_data;

        // Grab entreprises data 
        $data_entreprise = $this->entreprise_model->get_all_entreprises();
        foreach ($data_entreprise as $key) {
            $this->entreprise_data[$key->id] = $key;
        }
        $this->data->data_entreprise = $data_entreprise;
        // Load  all modules language file

        foreach ($this->module_data as $key => $value) {
            if (!empty($value->lang_file_name)) {
                $this->lang->load($value->name . '/' . $value->lang_file_name);
            }
        }
        if ($this->logged_in_user->group_id == 2) {
            $entreprises_list = $this->entreprise_model->get_manager_entreprises($this->logged_in_user->user_id);
            $this->data->my_entreprises = $entreprises_list;
        }

// Set template and data 

        $this->template->set_theme('backend/default_theme')->enable_parser(FALSE)->set_layout('default');
        $this->template->set_partial('header', 'partials/header', $this->data)->set_partial('metadata', 'partials/metadata');
        $this->template->set_partial('sidebar', 'partials/sidebar', $this->data)->set_partial('footer', 'partials/footer');
        $this->template->append_metadata('<script type="text/javascript">$(document).ready(function() {  $("#loader").hide();});</script>');
         (is_ajax()) ?$this->template->set_layout(FALSE):'';
    }

    private function _check_access() {
        
        $current_segment = $this->current_module . '/' . $this->current_controller;
        if ($this->logged_in_user->group_id == 1) {
            return true;
        }
        if ($this->current_module !== 'dashboard' && $this->module_data[$this->current_module]->type == 'mod_manager') {
            if ($this->logged_in_user->group_id == 2)
                return true;
        }
        if ($this->current_module !== 'dashboard' && $this->module_data[$this->current_module]->type == 'mod_entreprise') {
            if ($this->logged_in_user->group_id == 2 or $this->logged_in_user->group_id == 3) {
                return true;
            }
        }
        // Admin only can access to dashboard site settings 
        if ($this->current_segment === 'dashboard/settings') {
            if ($this->logged_in_user->group_id == 1)
                return true;
            else
                return false;
        }

        if (in_array($current_segment, $this->ignored_segments)) {
            return true;
        } else if ($current_segment == 'permissions/manage') {
            if ($this->session->userdata('ghost_permission')) {
                return true;
            }
        } else if (in_array($this->requested_module, $this->user_rules)) {
            return true;
        } else if ($this->current_method == 'index') {
            $has_access = false;
            foreach ($this->user_rules as $k) {
                if (in_array($this->current_module, $k)) {
                    $has_access = true;
                    break;
                }
            }
            return $has_access;
        }
    }

}