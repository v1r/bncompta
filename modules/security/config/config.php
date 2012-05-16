<?php
 
/**
 *  
 *  Here we are going to define our firewall 
 *  authentification mechanism and all security related configuration
 *  
 */
/* ---------------------------------------------
 * 
 * We define our entities  
 */
$config['entities'] = array(
    'login_attempts' => 'Entities\SecurityLoginAttempts' 
    );
$config['database_auth_config'] = array(
    'Entities\Staffs' => array('identification', 'email', 'firstName' ),
    'Entities\Students' => array('identification', 'email', 'firstName')
);


$config['auth_method'] = array(
    'source' => array(
        'database' => $config['database_auth_config'],
        'open_id' => '',
        'facebook_connect' => '',
        'twitter' => ''
        ));


?>