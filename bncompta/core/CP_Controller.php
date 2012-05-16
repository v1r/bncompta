<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CP_Controller extends BNCOMPTA_Controller {

    public $current_entreprise;

    function __construct() {

        parent::__construct();
        $this->data = (object) array();
        $this->template->set_theme('backend/default_theme')->enable_parser(FALSE)->set_layout('default');
        $this->template->set_partial('header', 'partials/header', $this->data)->set_partial('metadata', 'partials/metadata');
        $this->template->set_partial('sidebar', 'partials/sidebar', $this->data)->set_partial('footer', 'partials/footer');
        $this->template->append_metadata('<script type="text/javascript">$(document).ready(function() {  $("#loader").hide();});</script>');
        (is_ajax()) ? $this->template->set_layout(FALSE) : '';
    }

}