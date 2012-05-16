<?php

/* * *
 * 
 *  Router config
 * 
 */
$route['cp/modules/'] = 'modules';
$route['cp/modules'] = 'modules/cpModulesController';
$route['cp/modules/index'] = 'modules/cpModulesController/index';
$route['cp/modules'] = 'modules/cpModulesController';
$route['cp/modules/manage'] = 'modules/cpModulesController';
$route['cp/modules/manage/index'] = 'modules/cpModulesController/index';
$route['cp/modules/install/process/'] = 'modules/cpModulesController/installAction';
$route['cp/modules/install/process/(:any)'] = 'modules/cpModulesController/installAction/$1';
$route['cp/modules/view'] = 'modules/cpModulesController/viewAction';
$route['cp/modules/view/(:any)'] = 'modules/cpModulesController/viewAction/$1';
?>
