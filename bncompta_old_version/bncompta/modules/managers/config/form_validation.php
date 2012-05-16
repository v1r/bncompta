<?php

$config = array(
    'add_manager' => array(
        array('field' => 'username', 'label' =>  'lang:common_username_label', 'rules' => 'required|alphanumeric|maxlength[20]|callback__check_username'),
        array('field' => 'email', 'label' =>    'lang:common_email_label', 'rules' => 'required|valid_email|callback__check_email'),
        array('field' => 'first_name', 'label' =>  'lang:common_first_name_label', 'rules' => 'required|utf8'),
        array('field' => 'last_name', 'label' =>  'lang:common_last_name_label', 'rules' => 'required|utf8'),
        array('field' => 'password', 'label' =>  'lang:common_password_label', 'rules' => '|required|matches[confirm_password]|min_length[6]|alphanumeric|max_length[20]'),
        array('field' => 'confirm_password', 'label' =>  'lang:common_confirm_password_label', 'rules' => 'required')
    )
);
?>

