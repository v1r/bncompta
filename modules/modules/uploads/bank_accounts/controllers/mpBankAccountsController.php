<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MpBankAccountsController extends Enterprises_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('bank_accounts_model');
        $this->template->append_metadata('<script src="' . THEME_PATH . '/js/iban.js"></script>');
        $this->config->load('form_validation');
    }

    public function indexAction() {
        $this->data->bank_accounts = $this->bank_accounts_model->get_bank_account_data($this->current_entreprise, FALSE);
        $this->template->build('tpl/overview_view.php');
    }

    public function addAction() {
        if ($this->form_validation->run('bank_accounts') !== FALSE) {
            $cbanque = $this->input->post('rib_bank_code');
            $cguichet = $this->input->post('rib_branch_code');
            $nocompte = $this->input->post('rib_account_number');
            $clerib = $this->input->post('rib_key');

            $data = array(
                'label' => underscore($this->input->post('label')),
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'contact' => $this->input->post('contact'),
                'rib' => $cbanque . $cguichet . $nocompte . $clerib,
                'bic' => $this->input->post('bic'),
                'iban' => $this->input->post('iban'),
                'contact' => $this->input->post('contact'),
                'description' => $this->input->post('description')
            );

            if ($this->bank_accounts_model->add_bank_account($data)) {
                $this->session->set_flashdata('success', lang('success_message'));
            } else {
                $this->session->set_flashdata('error', lang('error_message'));
            }
            foreach ($this->config->item('bank_accounts') as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
            $this->data->repopulate = & $repopulate;
            redirect('bank_accounts/manage');
        } else {

            foreach ($this->config->item('bank_accounts') as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
            $this->data->repopulate = & $repopulate;
        }
        $this->template->build('tpl/create_view', $this->data);
    }

    public function editAction($bank_account_id, $action = '') {

        if ($action === 'update' AND $this->input->post() === FALSE) {
            redirect('bank_accounts/manage');
            exit();
        } elseif ($action === 'update') {

            if ($this->form_validation->run('bank_accounts') !== FALSE) {
                $cbanque = $this->input->post('rib_bank_code');
                $cguichet = $this->input->post('rib_branch_code');
                $nocompte = $this->input->post('rib_account_number');
                $clerib = $this->input->post('rib_key');
                $bank_account_id = $this->uri->segment(4);

                $data = array(
                    'label' => underscore($this->input->post('label')),
                    'name' => $this->input->post('name'),
                    'address' => $this->input->post('address'),
                    'contact' => $this->input->post('contact'),
                    'rib' => $cbanque . $cguichet . $nocompte . $clerib,
                    'bic' => $this->input->post('bic'),
                    'iban' => $this->input->post('iban'),
                    'contact' => $this->input->post('contact'),
                    'description' => $this->input->post('description')
                );

                if ($this->bank_accounts_model->update_bank_account($bank_account_id, $data)) {
                    $this->session->set_flashdata('success', lang('success_message'));
                    redirect('bank_accounts/manage');
                } else {
                    $this->session->set_flashdata('error', lang('error_message'));
                }
                foreach ($this->config->item('bank_accounts') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
                //redirect('bank_accounts/manage');
            } else {

                foreach ($this->config->item('bank_accounts') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
            }
        } else {
            $this->data->repopulate = $this->bank_accounts_model->get_bank_account_data($this->current_entreprise, $bank_account_id);
            if (empty($this->data->repopulate)) {
                redirect('bank_accounts/manage');
                exit();
            }
        }
        $this->template->build('tpl/edit_view', $this->data);
    }

    /**
     * Credit to wikipedia
     * @see http://fr.wikipedia.org/wiki/Basic_Bank_Account_Number#Algorithme_de_v.C3.A9rification_en_PHP
     */
    function _check_rib() {
        $cbanque = $this->input->post('rib_bank_code');
        $cguichet = $this->input->post('rib_branch_code');
        $nocompte = $this->input->post('rib_account_number');
        $clerib = $this->input->post('rib_key');
        $tabcompte = "";
        $len = strlen($nocompte);
        if ($len != 11) {
            return false;
        }
        for ($i = 0; $i < $len; $i++) {
            $car = substr($nocompte, $i, 1);
            if (!is_numeric($car)) {
                $c = ord($car) - (ord('A') - 1);
                $b = ($c + pow(2, ($c - 10) / 9)) % 10;
                $tabcompte .= $b;
            } else {
                $tabcompte .= $car;
            }
        }

        $int = $cbanque . $cguichet . $tabcompte . $clerib;
        return (strlen($int) >= 21 && bcmod($int, 97) == 0);
    }

    /**
     * Credit to wikipedia
     * @see http://fr.wikipedia.org/wiki/Basic_Bank_Account_Number#Algorithme_de_v.C3.A9rification_en_PHP
     */
    function isValideIBAN($s_IBAN) {
        // Vérification que le numéro IBAN est bien défini
        if (empty($s_IBAN))
            return false;

        // Nettoyage des caractères de formatage et mise en Capital
        $s_IBAN = strtoupper(trim($s_IBAN));
        /* Vérification de l'IBAN par rapport au modèle :
          - Ne comporte pas ' espace , . / - ? : ( ) , " +
          - Suppression des caractères IBAN en début de phrase si présent
          - Déplacement des 4 premiers caractères (2 lettres et 2 chiffres) à la fin de la chaîne
          - Remplacement des caractères alphabétiques comme suit : A->10, B->11 C->12... Z->35
          - Vérifie que le modulo 97 donne 1
         */
        $s_modele = array('/[\'\s\/\-\?:\(\)\.,"\+]/', '/^IBAN(.+)/', '/([[:alpha:]]{2}[[:digit:]]{2})([[:alnum:]]+)/', "/([A-Z])/e");
        $s_retour = array('', '\1', '\2\1', "ord('\\1')-55");
        $i_IBAN = preg_replace($s_modele, $s_retour, $s_IBAN);

        return ((bcmod($i_IBAN, 97) == 1) ? true : false);
    }

}