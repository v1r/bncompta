<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Karim Besbes
 * @description nothing much to say -_-' 
 */
class MY_Controller extends CI_Controller {

    /**
     * @access public 
     */
    public $current_module;
    public $current_controller;
    public $current_method;
    public $user_rules;
    public $requested_module;
    public $current_segment;
    public $module_data;
    public $controller_data;
    public $method_data;
    public $method_name;
    public $entreprise_data;
    public $modules_location;

    /**
     * 
     * @author Karim Besbes 
     * Parent constructor
     * 
     */
    function __construct() {

        //Set the parent constructor
        parent::__construct();

        // Load our models 
        $this->load->model('permissions/permission_model');
        $this->load->model('modules/mods_model');

        // Get the user data objects 
        if ($this->kb_auth->already_logged_in()) {
            $this->logged_in_user = $this->kb_auth->get_user_data();
            if ($this->setting->site_status == 1) {
                if ($this->logged_in_user->group_id != 1) {
                    $this->session->sess_destroy();
                    show_error('Le site est hors ligne.');
                }
            }

            // Get current visited uri segment 

            $this->current_module = $this->router->fetch_module();
            $this->current_controller = $this->router->fetch_class();
            $this->current_method = $this->router->fetch_method();

            // Let's put them in an array

            $this->requested_module = array($this->current_module, $this->current_controller, $this->current_method);

            //Get user rules in an array 
            $this->user_rules = $this->permission_model->get_user_rules();

            $modules = (object) ($this->mods_model->get_all_modules());

            $this->module_data = new ArrayObject($modules, ArrayObject::ARRAY_AS_PROPS);

            $this->current_segment = $this->current_module . '/' . $this->current_controller;

            $this->modules_location = array_keys(Modules::$locations);
            
        }
    }

}

// $var = array( 'controller' => 'manage','methods' => array('add' ,'add_entreprise')); 
// dump(serialize($var));