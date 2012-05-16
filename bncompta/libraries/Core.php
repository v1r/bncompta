<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 *  BNCOMPTA
 *  @package BNCOMPTA
 *  @author Karim BESBES - BNCOMPTADev Team 
 *  @copyright Copyright(c) 2011 2012
 *  @license 
 *  @since  Version 0.1
 *  
 */

/**
 *    
 */
class Core {

    private $bncompta; // CI Instance

    /**
     * 
     *  Constructor 
     * 
     */
    public $auth;
    public $acl;

    function __construct() {

        // Local reference bncompta super object
        $this->bncompta = & get_instance();
        $this->_init_core();
    }

    function _init_core() {

        // We simplify things with constants 
        // Load the url helper 
        // Load application helper
        // Load the app helper of Bncompta
        $this->bncompta->load->helper('app');
        // Load CI Helper
        $this->bncompta->load->helper(array('url', 'form', 'text', 'language', 'string', 'array', 'date', 'inflector'));



        $theme_name = 'backend/default_theme';

        /**
          |--------------------------------------------------------------------------
          | Defining assets and theme paths
          |--------------------------------------------------------------------------
         */
        define('THEME_FOLDER_PATH', base_url() . 'themes/');
        define('TEMPLATE_PATH', base_url() . 'themes/' . $theme_name);
        define('TEMPLATE_NAME', $theme_name);
        define('JS_LIBS_FOLDER_PATH', TEMPLATE_PATH . "js/libs/");
        define('JS_FOLDER_PATH', TEMPLATE_PATH . "js/");
        define('CSS_FOLDER_PATH', TEMPLATE_PATH . "css/");

        $this->fetch_module = strtolower($this->bncompta->router->fetch_module());
        $this->fetch_class = strtolower($this->bncompta->router->fetch_class());
        $this->fetch_method = strtolower($this->bncompta->router->fetch_method());
        $this->fetch_module_class = strtolower($this->fetch_module . '/' . $this->fetch_class);
        $this->fetch_module_class_method = strtolower($this->fetch_module . '/' . $this->fetch_class . '/' . $this->fetch_method);
 
        $this->bncompta->load->database();

        $this->bncompta->load->library(array('session', 'template', 'parser', 'form_validation', 'settings/setting'));

        $this->bncompta->lang->load('core');
 
        $this->bncompta->load->model('permissions/permission_model');
         
        
        $this->auth = $this->bncompta->load->library('security/bncompta_auth');

        $userAcl = $this->bncompta->session->userdata("acl");
   
        $this->acl = $this->bncompta->load->library('security/acl', $userAcl);

        $this->moduleforge = $this->bncompta->load->library('modules/ModuleForge');
    }

}

