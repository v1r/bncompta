<?php

class Security_Controller extends BNCOMPTA_Controller {

    public $captcha_enabled;

    function __construct() {
        parent::__construct();
        $this->validation_config = array(
            array(
                'field' => 'username',
                'label' => lang('username_label'),
                'rules' => 'required|callback__check_login'
            ),
            array(
                'field' => 'password',
                'label' => lang('password_label'),
                'rules' => 'required'
            )
        );

        // Load file language 
        $this->lang->load('login');

        // Set validation
        $this->form_validation->set_rules($this->validation_config);
        // We set our template theme

        $this->template->set_layout(FALSE)->set_theme('backend/default_theme');
 

        if ($this->form_validation->run() OR $this->core->auth->already_logged_in()) {
 
            redirect(get_route(('dashboard/' . strtoupper($this->session->userdata('interface')) . 'DashboardController')));
        }
    }

}

/* End of file logout.php */
/* Location: ./modules/security/logout.php */