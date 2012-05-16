<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Karim Besbes
 * @description nothing much to say -_-' 
 */
class BNCOMPTA_Controller extends CI_Controller {

    /**
     * 
     * @author Karim Besbes 
     * Parent constructor
     * 
     */
    function __construct() {

        //Set the parent constructor
        parent::__construct();
        $this->modules = $this->core->moduleforge->initModules();

        $this->userACL = $this->session->userdata("acl");

        // Get the user data objects 
        if ($this->core->auth->already_logged_in()) {
            $this->user =  (object) $this->logged_in_user = $this->session->all_userdata();

            if (!isset($this->logged_in_user)) {
                redirect('auth/login');
                exit;
            }
        }
    }

}

// $var = array( 'controller' => 'manage','methods' => array('add' ,'add_entreprise')); 
// dump(serialize($var));