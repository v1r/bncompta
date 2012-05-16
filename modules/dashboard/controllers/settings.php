<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Backend {

    function __construct() {
        parent::__construct();
        $this->lang->load('settings');
        /**
         * Set the validation array 
         * 
         */
        // If the javascript validation fail, we make sure to validate fields

        $this->validation_config = array(
            array('field' => 'site_name', 'label' => lang('common_site_name'), 'rules' => 'required|xss_clean'),
            array('field' => 'site_status', 'label' => lang('common_site_status'), 'rules' => 'required|numeric'),
            array('field' => 'site_offline_message', 'label' => lang('common_site_offline_message'), 'rules' => 'required|xss_clean'),
        );
    }

    public function index() {

        $this->form_validation->set_rules($this->validation_config);
        $this->form_validation->set_error_delimiters('<span class="validate_error">', '</span>');


        // We try to add the entreprise
        if ($this->form_validation->run() !== FALSE) {
            if ($_POST) {
                $site_name = $this->input->post('site_name');
                $site_status = $this->input->post('site_status');
                $site_offline_message = $this->input->post('site_offline_message');
                $this->setting->site_name = $site_name;
                $this->setting->site_status = $site_status;
                $this->setting->site_offline_message = $site_offline_message;
            }
        }
        $this->template->build('tpl/settings_view');
    }

}