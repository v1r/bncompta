<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Entreprise extends Entreprises {

    function __construct() {
        parent::__construct();
        $this->lang->load('dashboard');
    }

    public function index() {
        /**
         * @todo Check if the current user has access to the entreprise [ok]
         * @todo get current entreprise data                            [ok]  
         * @todo if manager, load entreprise modules data               [ok]
         * @todo if normal user, load user roles                      
         * @todo check if the entreprise profile has been updated
         * @todo add user roles  
         */

        $entreprise_id = $this->session->userdata('entreprise_id');
        $entreprise_data = $this->entreprise_model->get_manager_entreprises($this->logged_in_user->user_id); 
        
        //Entreprise data 
        $this->data->entreprise_data = array();
        $this->data->entreprise_modules = array() ;
        foreach($entreprise_data as $key => $value)
        {
            if($entreprise_data[$key]->id == $entreprise_id)
            { 
                $this->data->entreprise_data = $entreprise_data[$key]; 
            }
        }
        
        // Entreprise modules 
        $entreprise_modules = unserialize($this->entreprise_model->get_entreprise_modules_by_id($entreprise_id));
        
        foreach($entreprise_modules as $key) 
        { 
            $this->data->entreprise_modules[] = $this->mods_model->get_module_by_id($key);
        }
        $this->template->build('entreprise_dashboard', $this->data);
    }
    


}