<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * 
 * @name Backend authentification 
 * @package BNCCompta
 * @subpackage Controllers 
 * @author Karim Besbes 
 * @see http://www.karimbesbes.com   
 * @version 0.0.1 
 * 
 *  
 * */
class Auth extends My_Controller {

    /**
     * Constructor method
     * @access public
     * @return void
     */
    public function __construct() {
        // We call the parent controller 
        parent::__construct();

        // We set the validation rules 

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
    }

    /**
     * Display the control panel
     * @access public
     * @return void
     */
    public function index() {

        if ($this->kb_auth->already_logged_in()) {
            /**
             * @todo if it's a normal user, redirect to the entreprise dashboard
             */
            redirect('dashboard/home');
        }
        else
            redirect('auth/login');

        $this->template->build('dashboard');
    }

    /**
     * Authentification page 
     * @access public
     * @return void
     */
    public function login() {
        if ($this->form_validation->run() or $this->kb_auth->already_logged_in()) {
            redirect('auth');
        }
        $this->template->build('login');
    }

    public function _check_login($login) {
        if (!$this->kb_auth->authentificate($login, $this->input->post('password'))) {
            $this->form_validation->set_message('_check_login', '<p>error login</p><br />');
            return FALSE;
        }
        return TRUE;
    }

}