<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * 
 * @name Logout  
 * @package BNCCompta
 * @subpackage Controllers 
 * @author Karim Besbes 
 * @see http://www.karimbesbes.com   
 * @version 0.0.1 
 * 
 *  
 * */
class Logout extends BNCOMPTA_Controller {

    /**
     * Constructor method
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
   
    }

    /**
     * Display the control panel
     * @access public
     * @return void
     */
    public function index() {
        $this->core->auth->logout();
        redirect('logout/redirect');
    }

    public function redirect() {
        $this->session->set_flashdata('success_message', 'OMG THIS IS WORKING');
        redirect('auth/login');
    }

}