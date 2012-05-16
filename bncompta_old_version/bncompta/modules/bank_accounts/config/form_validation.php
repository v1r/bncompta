<?php

$config = array(
    'bank_accounts' => array(
        array('field' => 'label', 'label' => 'lang:bank_accounts.slug_label', 'rules' => 'required|maxlength[30]'),
        array('field' => 'name', 'label' => 'lang:bank_accounts.name_label', 'rules' => 'required'),
        array('field' => 'address', 'label' => 'lang:bank_accounts.address_label', 'rules' => 'required|utf8'),
        array('field' => 'rib', 'label' => 'lang:bank_accounts.rib_label', 'rules' => 'required|utf8'),
        array('field' => 'rib_bank_code', 'label' => 'lang:bank_accounts.rib_code', 'rules' => 'required|utf8'),
        array('field' => 'rib_branch_code', 'label' => 'lang:bank_accounts.rib_branch_code', 'rules' => 'required|utf8'),
        array('field' => 'rib_account_number', 'label' => 'lang:bank_accounts.rib_account_number', 'rules' => 'required|utf8'),
        array('field' => 'rib_key', 'label' => 'lang:bank_accounts.rib_key', 'rules' => 'required|utf8'),
        array('field' => 'bic', 'label' => 'lang:bank_accounts.BIC_label', 'rules' => 'trim|required'),
        array('field' => 'iban', 'label' => 'lang:bank_accounts.iban_label', 'rules' => 'trim|required|utf8'),
        array('field' => 'contact', 'label' => 'lang:bank_accounts.contact_label', 'rules' => 'required|utf8'),
        array('field' => 'description', 'label' => 'lang:bank_accounts.description_label', 'rules' => 'required|utf8'),
    // Uncomment to activate rib validation        
//array('field' => 'rib', 'label' => lang('RIB_label'), 'rules' => 'callback__check_rib')
    )
);
?>