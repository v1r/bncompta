<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Analyse extends Entreprises {

    function __construct() {
        parent::__construct();
        $this->template->set_partial('sidebar', 'tpl/accounting_year/sidebar');
    }

    public function index() {

        $this->template->build('tpl/analyse/overview_view.php');
    }

}