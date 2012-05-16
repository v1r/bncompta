<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
 **/
 
class Logout extends My_Controller
{
	/**
	 * Constructor method
	 * @access public
	 * @return void
	 */
	public function __construct()
	{   
	    parent::__construct();
	   // Load file language 
        $this->lang->load('login') ;
        $this->load->library('kb_auth') ;
 	}

 	/**
 	 * Display the control panel
	 * @access public
	 * @return void
 	 */
     
 	public function index()
	{
	  $this->kb_auth->logout();
      redirect('logout/redirect'); 
	}
    
    public function redirect()
    {
        $this->session->set_flashdata('success_message', 'OMG THIS IS WORKING');
        redirect('auth/login'); 
    }
}