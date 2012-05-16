<?php

$config = array(
    'login' => array(
        array(
            'field' => 'identity',
            'label' => 'lang:core.security_identity_field',
            'rules' => 'required|callback_check_login[identity]'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:core.security_password_field',
            'rules' => 'required'
        )
    )
);
?>
