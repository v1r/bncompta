<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Karim Besbes
 * @created on 15/08/2011
 */
class Accounting_year extends Entreprises {

    function __construct() {
        parent::__construct();
        $this->load->model('accounting_model');
        $this->template->append_metadata('<script src="' . THEME_PATH . '/js/iban.js"></script>');
        $this->config->load('form_validation');
        $this->data->accounting_year = $this->accounting_model->get_all_accounting_year();
        $this->template->set_partial('sidebar', 'tpl/accounting_year/sidebar', $this->data);
        $uri_accounting_year = $this->uri->segment(4);
        $entreprise_id = $this->session->userdata('entreprise_id');
        if (($uri_accounting_year)) {
            if (!($this->accounting_model->accounting_year_entreprise_has_access($uri_accounting_year, $entreprise_id))) {
                redirect('accounting/accounting_year');
                exit();
            }
        }
        $this->data->accounting_year = $this->accounting_model->get_all_accounting_year();
        $this->template->set_partial('navigation', 'tpl/accounting_year/navigation_view', $this->data);
    }

    public function index() {
        $this->template->build('tpl/accounting_year/overview_view.php', $this->data);
    }

    public function add() {
        if ($this->form_validation->run('accounting_year') !== FALSE) {
            $data = array(
                'label' => underscore($this->input->post('label')),
                'description' => $this->input->post('description'),
                'start_date' => strtotime($this->input->post('start_date')),
                'end_date' => strtotime($this->input->post('end_date')),
                'is_default' => $this->input->post('is_default')
            );

            if ($this->accounting_model->add_new_accounting_year($data)) {
                $this->session->set_flashdata('success', lang('success_message'));
            } else {
                $this->session->set_flashdata('error', lang('error_message'));
            }
           
            redirect('accounting/accounting_year');
        } else {

            foreach ($this->config->item('accounting_year') as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
            $this->data->repopulate = & $repopulate;
        }

        $this->template->build('tpl/accounting_year/create_view', $this->data);
    }

    public function edit($accounting_year_id) {
        if ($_POST) {
            if ($this->form_validation->run('accounting_year') !== FALSE) {
                $data = array(
                    'label' => underscore($this->input->post('label')),
                    'description' => $this->input->post('description'),
                    'start_date' => strtotime($this->input->post('start_date')),
                    'end_date' => strtotime($this->input->post('end_date')),
                    'is_default' => $this->input->post('is_default')
                );

                if ($this->accounting_model->update_accounting_year($data, $accounting_year_id)) {
                    $this->session->set_flashdata('success', lang('success_message'));
                    redirect('accounting/accounting_year');
                } else {
                    $this->session->set_flashdata('error', lang('error_message'));
                }
            } else {

                foreach ($this->config->item('accounting_year') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
            }
        } else {
            $repopulate = $this->accounting_model->get_accounting_year_data($accounting_year_id);
            $this->data->repopulate = $repopulate[0];
        }


        $this->template->build('tpl/accounting_year/edit_view', $this->data);
    }

    public function close($accounting_year_id, $confirm ='') {

        if ($confirm == 'confirmed') {
            if ($this->accounting_model->close_accounting_year($accounting_year_id)) {
                $this->session->set_flashdata('success', 'L\'exercice a été clôturé avec succès.');
                redirect('accounting/accounting_year/');
            } else {
                $this->session->set_flashdata('error', 'error_message');
                redirect('accounting/accounting_year/');
            }
        }
        $this->template->build('tpl/accounting_year/close_view');
    }

    public function open($accounting_year_id) {
      
      $this->session->set_userdata('accounting_year_id', $accounting_year_id) ;
    }

    public function delete($accounting_year_id, $confirm ='') {

        if ($confirm == 'confirmed') {
            if ($this->accounting_model->delete_accounting_year($accounting_year_id)) {
                $this->session->set_flashdata('success', 'L\'exercice a été supprimé avec succès.');
                redirect('accounting/accounting_year/');
            } else {
                $this->session->set_flashdata('error', 'error_message');
                redirect('accounting/accounting_year/');
            }
        }
        $this->template->build('tpl/accounting_year/close_view');
    }

    public function activate_accounting_year($accounting_year_id) {
        $this->accounting_model->activate_accounting_year($accounting_year_id);
    }

    public function desactivate_accounting_year($accounting_year_id) {
        $this->accounting_model->desactivate_accounting_year($accounting_year_id);
    }

    public function refresh_sidebar() {
        $this->data->accounting_year = $this->accounting_model->get_all_accounting_year();
        $this->template->set_layout(false)->build('tpl/accounting_year/ajax_refresh_sidebar', $this->data);
    }

}