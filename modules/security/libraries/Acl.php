<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 *  BNCOMPTA
 *  @package BNCOMPTA Access List Control
 *  @author Karim BESBES - BNCOMPTADev Team 
 *  @copyright Copyright(c) 2011 2012
 *  @license 
 *  @since  Version 0.1
 *  
 */

/**
 *    
 */
class Acl {

    private $bncompta; // CI Instance

    /**
     * 
     *  Constructor 
     * 
     */

    function __construct() {

        // Local reference bncompta super object
        $this->bncompta = & get_instance();
 
    }

    function check_access($module = '', $class = '', $method = '') {
        
       
    }
    
    function has_access() {
       
    }

}

