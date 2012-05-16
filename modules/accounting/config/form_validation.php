<?php

$config = array(
    'accounting_year' => array(
        array('field' => 'label', 'label' => 'lang:common.label_label', 'rules' => 'required|maxlength[30]'),
        array('field' => 'description', 'label' => 'lang:common.description_label', 'rules' => 'required'),
        array('field' => 'start_date', 'label' => 'lang:common.start_date_label', 'rules' => 'required'),
        array('field' => 'end_date', 'label' => 'lang:common.end_date_label', 'rules' => 'required'),
        array('field' => 'is_default', 'label' => 'lang:common.is_default_label', 'rules' => 'required'),
    ),
    'bank_statements' => array(
        array('field' => 'bank_account_id', 'label' => 'lang:common.bank_account_label', 'rules' => 'required|numeric'),
        array('field' => 'label', 'label' => 'lang:common.label_label', 'rules' => 'required|maxlength[30]'),
        array('field' => 'description', 'label' => 'lang:common.description_label', 'rules' => 'required'),
        array('field' => 'date', 'label' => 'lang:common.date_label', 'rules' => 'required'),
        array('field' => 'ammount', 'label' => 'lang:accounting.ammount_label', 'rules' => 'required|numeric'),
    ),
    'expenditures' => array(
        array('field' => 'expenditure_type_id', 'label' => 'lang:common.type_label', 'rules' => 'required|numeric'),
        array('field' => 'description', 'label' => 'lang:common.description_label', 'rules' => 'required'),
        array('field' => 'date', 'label' => 'lang:common.date_label', 'rules' => 'required'),
        array('field' => 'ht', 'label' => 'lang:accounting.ht_label', 'rules' => 'required|numeric'),
        array('field' => 'tva', 'label' => 'lang:accounting.tva_label', 'rules' => 'required|numeric'),
        array('field' => 'file_path', 'label' => 'lang:accounting.attachment_label', 'rules' => ''),
    ),
    'incomes' => array(
        array('field' => 'income_type_id', 'label' => 'lang:common.type_label', 'rules' => 'required|numeric'),
        array('field' => 'client_id', 'label' => 'lang:accounting.client_label', 'rules' => 'required|numeric'),
        array('field' => 'description', 'label' => 'lang:common.description_label', 'rules' => 'required'),
        array('field' => 'date', 'label' => 'lang:common.date_label', 'rules' => 'required'),
        array('field' => 'ht', 'label' => 'lang:accounting.ht_label', 'rules' => 'required|numeric'),
        array('field' => 'tva', 'label' => 'lang:accounting.tva_label', 'rules' => 'required|numeric'),
        array('field' => 'file_path', 'label' => 'lang:accounting.attachment_label', 'rules' => ''),
    )
);
/*
 * 
 * 
 *                'bank_statement_id' => $this->input->post('bank_account_id'),
  'expenditure_type_id' => $this->input->post('expenditure_type_id'),
  'label' =>  $this->input->post('label'),
  'description' => $this->input->post('description'),
  'date' => $this->input->post('date'),
  'ht' => $this->input->post('ht'),
  'tva' => $this->input->post('tva'),
  'file_path' => $this->input->post('file_path'),
  'description' => $this->input->post('description')
 */
?>
