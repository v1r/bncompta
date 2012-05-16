<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CP_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('module_forge');
        $this->load->library('unzip');
        $this->template->set_partial('navigation', 'tpl/navigation_view');
    }

    public function index() {
        $this->data->not_installed_modules = $this->module_forge->get_not_installed_modules();
        (is_ajax()) ? $this->template->set_layout(FALSE) : '';
        $this->template->build('tpl/modules_list', $this->data);
 
    }

    public function install($module_dir) {

        $controller_path = 'uploads/' . $module_dir . '/controllers/';
        $controllers_methods = array();
        $data = $this->module_forge->parse_xml_config($module_dir);
        $controllers = $this->module_forge->get_module_controllers($module_dir);
        foreach ($controllers as $controller) {
            $controller_name = substr($controller, 0, strrpos($controller, '.'));
            $controllers_methods[$controller_name] = $this->module_forge->get_module_class_data($controller, $controller_path);
        }

        if ($this->module_forge->prepare_data($module_dir, $data, $controllers_methods)) {
            $this->unzip->extract('uploads/' . $module_dir . '.zip', 'extensions/modules/' . $data[$module_dir]['name']);
            $this->unzip->close();
            $this->module_forge->unlink_module_dir('uploads/' . $module_dir);
            @unlink('uploads/' . $module_dir . '.zip');
            @rmdir('uploads/' . $module_dir);
        }

        redirect('modules/manage');
    }

    public function update($module_name = '') {
        if (empty($module_name)) {
            redirect('modules/manage');
        }
        $controller_methods = $this->module_forge->refresh_class_data($module_name);
        $data = $this->module_forge->refresh_xml_data($module_name);
        $this->module_forge->prepare_data($module_name, $data, $controller_methods, $type = 'refresh');
        redirect('modules/manage');
    }

    public function activate($module_id = '') {

        if (!empty($module_id))
            $this->mods_model->activate_module($module_id);
    }

    public function desactivate($module_id = '') {
        $this->module_forge->get_not_installed_modules();
        if (!empty($module_id))
            $this->mods_model->desactivate_module($module_id);
    }

}