<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Backend  {

    function __construct() {
        parent::__construct();
        redirect('dashboard');
    }


}