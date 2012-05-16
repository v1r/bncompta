<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CpModulesController extends CP_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ModuleForge');
    }

    public function index() {
        
        $this->data->nonInstalledModules = $this->moduleforge->getNonInstalledModules();
        $this->data->installedModules = $this->moduleforge->getInstalledModules();
         
        $this->template->build("build/cp/modules_list_view");
    }

    public function viewAction($moduleName) {
   
        $xmlData = $this->moduleforge->parseXMLConfig($moduleName);
        $this->data->title = $xmlData[$moduleName]['title'];
        $this->data->description = $xmlData[$moduleName]['description'];
        $this->data->version = $xmlData[$moduleName]['version'];
        $this->data->overview = $xmlData[$moduleName]['overview'];
        $this->data->screenshot_path = $xmlData[$moduleName]['screenshot'];
        $this->data->thumbnail_path = $xmlData[$moduleName]['thumbnail'];
        $this->template->build('build/cp/modules_process_install_view', $this->data);
    }

    public function installAction($moduleName) {

        $xmlData = $this->moduleforge->parseXMLConfig($moduleName);

        $acl_classes = $this->moduleforge->moduleDirExists($moduleName, TRUE, TRUE);

        $acls = array();

        if (empty($acl_classes))
            show_error("unable to install this module");

        foreach ($acl_classes as $k) {
            array_push($acls, $this->moduleforge->getACLData($k, FALSE, TRUE));
        }

        $data = array(
            'name' => $xmlData[$moduleName]['name'],
            'title' => $xmlData[$moduleName]['title'],
            'description' => $xmlData[$moduleName]['description'],
            'enabled' => $xmlData[$moduleName]['enabled'],
            'is_core' => $xmlData[$moduleName]['is_core'],
            'version' => $xmlData[$moduleName]['version'],
            'icon_path' => $xmlData[$moduleName]['icon_path'],
            'resource_access_level' => $xmlData[$moduleName]['resource_access_level'],
            'resources' => $acls
        );
 
        $this->moduleforge->installModule($data);

     $this->core->acl->grantGroupAccess();
    }

    public function updateAction($moduleName) {
        
    }

}