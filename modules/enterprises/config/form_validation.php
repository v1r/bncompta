<?php

$config = array(
    'add_entreprise' => array(
        array('field' => 'label', 'label' => 'lang:common_entreprise_label', 'rules' => 'required|maxlength[30]'),
        array('field' => 'email', 'label' => 'lang:common_email_label', 'rules' => 'required|valid_email'),
        array('field' => 'name', 'label' =>  'lang:common_name_label', 'rules' => 'required|utf8'),
        array('field' => 'description', 'label' =>  'lang:common.description_label', 'rules' => 'required|utf8'),
    )
);
?>