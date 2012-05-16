<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CP_Controller  {

    function __construct() {
        parent::__construct();
        redirect('dashboard');
    }


}