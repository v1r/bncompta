<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Entreprises management controller 
 * 
 * @author Karim Besbes - BNCompta dev team
 * @package BNCompta 
 * @subpackage Entreprises module 
 * @copyright Copyright (c) 2011, BNCompta
 * @category Entreprises module
 * @since Version 0.1
 * 
 * */
class Manage extends CP_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('entreprises');
        $this->load->helper('inflector');
        $this->config->load('form_validation');
        foreach ($this->controller_data[$this->current_module] as $methods) {
            $this->method_data = $methods;
        }

        $this->method_name = array_keys($this->method_data);
        (is_ajax()) ? $this->template->set_layout(FALSE) : '';
        $this->template->set_partial('navigation', 'tpl/navigation_view');
       
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
        $this->data->methods = new ArrayObject($this->method_data, ArrayObject::ARRAY_AS_PROPS);
        $this->data->manager_name = $manager_name;
        $this->data->available_managers = $available_managers;
        $this->template->build('tpl/entreprise_list', $this->data);
    }

    public function add() {
        if ($_POST) {
            $label = underscore($this->input->post('label'));
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $description = $this->input->post('description');
            $modules = $this->input->post('modules');
        }
        // We try to add the entreprise
        if ($this->form_validation->run('add_entreprise') !== FALSE) {
            if ($this->entreprise_model->add_entreprise($label, $name, $email, $description, $modules)) {
                // Flash success
                $this->session->set_flashdata('success', lang('success_entreprise_add'));
                redirect('entreprises/manage');
            }
            else
                $this->session->flashdata('error', 'erreur');
        }
        else {
            foreach ($this->config->item('add_entreprise') as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
            $this->data->repopulate = & $repopulate;
        }
        $this->session->flashdata('success', 'ajout avec sucee');

        $this->data->mod_entreprise = $mod_entreprise = $this->entreprise_model->get_entreprise_modules();



        $this->template->build('tpl/add_entreprise_form', $this->data);
    }

    public function assign($entreprise_id, $manager_id) {
        $this->entreprise_model->remove_entreprise_manager($entreprise_id);
        $this->entreprise_model->assign_mananger($entreprise_id, $manager_id);
        $this->session->set_flashdata('success', lang('entreprise_manager_assigned'));
        redirect('entreprises/manage');
    }

    public function edit($entreprise_id) {
        if ($_POST) {
            if ($this->form_validation->run('add_entreprise') !== FALSE) {
                $data = array(
                    'label' => underscore($this->input->post('label')),
                    'description' => $this->input->post('description'),
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    'modules' => $this->input->post('modules')
                );

                if ($this->entreprise_model->update_entreprise($data, $entreprise_id)) {
                    $this->session->set_flashdata('success', lang('success_message'));
                } else {
                    $this->session->set_flashdata('error', lang('error_message'));
                }
                foreach ($this->config->item('accounting_year') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
                redirect('entreprises/manage');
            } else {

                foreach ($this->config->item('add_entreprise') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
            }
        } else {
            $repopulate = $this->entreprise_model->get_entreprise_data($entreprise_id);
            $this->data->repopulate = $repopulate[0];
        }
        $this->data->mod_entreprise = $mod_entreprise =  unserialize($this->entreprise_model->get_entreprise_modules_by_id($entreprise_id));
        $this->data->entreprise_mdoules = $entreprise_mdoules = $this->entreprise_model->get_entreprise_modules();
        $this->template->build('tpl/edit_entreprise_view');
    }

    public function ajax_update() {

        $entreprise_id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $description = $this->input->post('description');
        $this->entreprise_model->update_entreprise($name, $email, $description, $entreprise_id);
    }

    function ajax_notifications() {
        $data = array('notify' => ' Hi karim',
            'notify1' => 'besbes',
            'notify2' => ' Hi karim1',
            'notify3' => ' Hi karim2',
            'notify4' => ' Hi kari3m',
            'notify5' => ' Hi karrim',
            'notify6' => ' Hi kariem',
            'notify7' => ' Hi karrim',
            'notify8' => ' Hi karewim',
            'notify9' => ' Hi karirem',
            'notify10' => ' Hi karreim',
            'notify11' => ' Hi kadgrim',
            'notify12' => ' Hi kargfdim',
            'notify13' => ' Hi karfdsgim',
            'notify14' => ' Hi karsfdgsfim',
            'notify15' => ' Hi kasgrim',
            'notify16' => ' Hi kdaarim',
            'notify17' => ' Hi kaadsfrim',
        );

        $data_ = json_encode($data);
        echo $data;
        echo json_decode('{"notify0":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 0","notify1":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 1","notify2":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 2","notify3":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 3","notify4":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 4","notify5":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 5","notify6":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 6","notify7":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 7","notify8":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 8","notify9":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 9"}');
    }

}