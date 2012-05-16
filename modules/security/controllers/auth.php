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
class Auth extends Security_Controller {

    /**
     * Constructor method
     * @access public
     * @return void
     */
    public function __construct() {
        // We call the parent controller 
        parent::__construct();
      
    }

    /**
     * Display the control panel
     * @access public
     * @return void
     */
    public function index() {
        $this->login();
    }

    /**
     * Authentification page 
     * @access public
     * @return void
     */
    public function login() {
  
        $this->template->build('login');
    }
    

    public function _check_login($login) {

        if (!$this->core->auth->authentificate($login, $this->input->post('password'))) {
            $this->form_validation->set_message('_check_login', '<p>error login</p><br />');
            return FALSE;
        }

        return TRUE;
    }

}