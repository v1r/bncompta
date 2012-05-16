<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Backend {

    function __construct() {
        parent::__construct();
        $this->lang->load('dashboard');
    }

    public function index() {
       
        if ($this->session->userdata('group_id') == 3) {
            $user_entreprise_id = $this->entreprise_model->get_user_entreprise($this->session->userdata('id'));
            $this->session->set_userdata('entreprise_id',$user_entreprise_id);
            redirect('dashboard/entreprise/');
            exit();
        }

        $this->data->last_login = @date('d, M, Y, g:i a', $this->session->userdata('last_login'));
        $this->template->build('dashboard', $this->data);
    }

    public function ajax() {

        $data = array();
        $test = 'Les notifications seront affiches ici..';
        $data['notify'] = $test;
        $data_ = json_encode($data);
        echo $data_;
    }

    public function update_position() {

        $module_name = $this->input->post('module');
        $new_position = $this->input->post('position');
        $this->mods_model->update_module_position($module_name, $new_position );
    }
    public function update_browsing($entreprise_id)
    {
        $this->session->set_userdata('entreprise_id', $entreprise_id); 
       
    }

}