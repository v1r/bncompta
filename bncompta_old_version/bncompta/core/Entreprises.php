<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Entreprises extends Backend {

    public $entrerprises_list;
    public $current_accounting_year_id;

    function __construct() {
        parent::__construct();
        $this->load->model('accounting/accounting_model');
        $this->load->model('bank_accounts/bank_accounts_model');
        $entreprise_id = $this->session->userdata('entreprise_id');
        if ($this->session->userdata('accounting_year_id'))
            $this->current_accounting_year_id = $this->session->userdata('accounting_year_id');
        else
            $this->current_accounting_year_id = $this->accounting_model->get_entreprise_current_accounting_year_id($entreprise_id);
 
        if (!$this->session->userdata('entreprise_id')) {
            $this->session->set_flashdata('error', 'Vous devriez d\'abord selectionnez une entreprise');
            redirect('dashboard');
            exit;
        } else if ($this->current_module === 'dashboard' && $this->current_controller === 'entreprise') {
            $entreprise_id = $this->session->userdata('entreprise_id');
            if (!$this->entreprise_model->user_has_access($this->session->userdata('id'), $entreprise_id)) {
                redirect('dashboard');
                exit();
            }
        } else if ($this->module_data[$this->current_module]->type == 'mod_entreprise') {
            $entreprise_id = $this->session->userdata('entreprise_id');
            if (is_int($entreprise_id)) {
                if (!$this->entreprise_model->user_has_access($this->session->userdata('id'), $entreprise_id)) {
                    redirect('dashboard');
                    exit();
                }
            }
        }
    }

}