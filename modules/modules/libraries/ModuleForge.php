<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

/**
 * 
 * Modules manager library
 * Forge your module now!
 * @author Karim BESBES 
 * @package BNCOMPTA
 * @category Modules
 * @version v0.1
 */
define('MODULE_UPLOAD_DIR', 'modules/modules/uploads/');
define('MODULES_DIR', 'modules/');

class ModuleForge {

    /**
     * CodeIgniter global
     * @var string
     * */
    protected $bncompta;

    /**
     * construct
     * @return void
     * */
    public function __construct() {
        $this->bncompta = & get_instance();
        $this->em = $this->bncompta->doctrine->em;
    }

    /**
     * Function to check if module name already exists
     * @author Karim BESBES
     * @access private
     * @return bool 
     */
    public function getAllmodules() {
        return $this->em->getRepository('Entities\Modules')->findAll();
    }

    public function initModules() {
        $modules = array();
        $modulesList = $this->getAllmodules();
        foreach ($modulesList as $key) {
            $modules[$key->getModuleName()]['name'] = $key->getModuleName();
            $modules[$key->getModuleName()]['title'] = $key->getModuleTitle();
            $modules[$key->getModuleName()]['description'] = $key->getModuleDescription();
            $modules[$key->getModuleName()]['isCore'] = $key->getModuleIsCore();
            $modules[$key->getModuleName()]['isEnabled'] = $key->getModuleIsEnabled();
            $modules[$key->getModuleName()]['iconPath'] = $key->getModuleIconPath();
            $modules[$key->getModuleName()]['position'] = $key->getModulePosition();
        }
        return $modules;
    }

    /**
     * Persist module and its resources data 
     * @param type $data 
     */
    public function installModule($data) {
        $resource_access_level = array();
        if (key_exists('resource_access_level', $data)) {
            foreach ($data['resource_access_level']->children() as $resource) {
                $resourceName = (string) $resource->attributes()->name;
                $interfaceType = (string) $resource->attributes()->interface_type;
                $resource_access_level[$resourceName]['level'] = array();
                foreach ($resource as $level) {
                    array_push($resource_access_level[$resourceName]['level'], (int) $level);
                }
                $resource_access_level [$resourceName]['interface_type'] = $interfaceType;
            }
        }

        $module = $this->bncompta->doctrine->em->getRepository('Entities\Modules')->findByModuleName((string) $data['name']);

        if ($module) {
            show_error("This module already exists in the database.");
        }

        $module = new Entities\Modules;
        $module->setModuleTitle($data['title']);
        $module->setModuleName($data['name']);
        $module->setModuleDescription($data['description']);
        $module->setModuleIsCore($data['is_core']);
        $module->setModuleVersion($data['version']);
        $module->setModuleIsEnabled($data['enabled']);
        $module->setModuleIconPath($data['icon_path']);
        $module->setModulePosition(0);
        $this->bncompta->doctrine->em->persist($module);
        $this->bncompta->doctrine->em->flush();

        foreach ($data['resources'] as $key) {
            $i = 0;
            foreach ($key as $res => $value) {

                $resource = new Entities\AclResources;
                $resource->setModule($module);
                $resource->setResourceIdentifer(strtolower($res));
                $resource->setResourceDescription('db.' . strtolower($data['name']) . '_' . strtolower($res) . '_resource_lang');
                $resource->setResourceType($resource_access_level[strtolower($res)]['interface_type']);
                $resource->setCreatedOn(now());
                $this->bncompta->doctrine->em->persist($resource);
                $this->bncompta->doctrine->em->flush();

                // We set the default Access control list 
                if (key_exists('resource_access_level', $data) AND !empty($resource_access_level[$resource->getResourceIdentifer()]['level'])) {
                    if (key_exists($resource->getResourceIdentifer(), $resource_access_level)) {
                        foreach ($resource_access_level[$resource->getResourceIdentifer()]['level'] as $key => $level) {
                            $this->bncompta->core->acl->addGroupPermission($resource->getResourceIdentifer(), $level, $access_type = Acl::ACCESS_GRANTED);
                        }
                    }
                }
            }

            foreach ($value as $role) {
                $i++;
                $action = new Entities\AclActions;
                $action->setResources($resource);
                $action->setActionIdentifer(strtolower($role));
                $action->setActionDescription((strtolower('db.' . strtolower($data['name']) . '_' . strtolower($res) . '_' . strtolower($role) . '_role_lang')));
                $action->setRoleOrder($i);
                $action->setCreatedOn(now());
                $this->bncompta->doctrine->em->persist($action);
                $this->bncompta->doctrine->em->flush();
            }
        }

        unset($module);
        unset($resource);
        unset($action);
    }

    private function moveModuleFolder() {
        // Get array of all source files
        $files = scandir("source");
        // Identify directories
        $source = "source/";
        $destination = "destination/";
        // Cycle through all source files
        foreach ($files as $file) {
            if (in_array($file, array(".", "..")))
                continue;
            // If we copied this successfully, mark it for deletion
            if (copy($source . $file, $destination . $file)) {
                $delete[] = $source . $file;
            }
        }
        // Delete all successfully-copied files
        foreach ($delete as $file) {
            unlink($file);
        }
    }

    public function moduleDirExists($raw_name = '', $returnAcl = FALSE, $fromUploadDir = FALSE) {
        if ($fromUploadDir) {

            $dir = MODULE_UPLOAD_DIR . $raw_name;
            if (file_exists($dir)) {
                $controller = $this->getModuleControllers($dir);
                if ($returnAcl) {

                    return $controller;
                }
                return TRUE;
            }
        } else {
            foreach (config('core', 'modules') as $module) {
                foreach (Modules::$locations as $k => $v) {
                    $dir = $k . $raw_name;
                    if (file_exists($dir)) {
                        $controller = $this->getModuleControllers($dir);
                        if ($returnAcl) {
                            return $controller;
                        }
                        return TRUE;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get controllers names
     * @author Karim Besbes
     */
    public function getModuleControllers($module_dir) {
        $controller_dir = $module_dir . '/controllers';
        $files = array();
        $handle = opendir($controller_dir);
        while (($current_dir = readdir($handle)) !== false) {
            if (substr($current_dir, strrpos($current_dir, '.') + 1) == 'php') {
                $files[] = $controller_dir . '/' . $current_dir;
            }
        }
        return $files;
    }

    /**
     * Get controller name and methods from controllers source code 
     * @author Karim BESBES
     * @return array 
     */
    public function getACLData($module_dir, $upload = FALSE, $fullDir = FALSE) {

        $controller_path = '';
        if (!$fullDir) {
            if ($upload == TRUE) {
                $controller_path = 'modules/' . $module_dir;
            } else {
                $controller_path = MODULE_UPLOAD_DIR . $module_dir;
            }
        } else {
            $controller_path = $module_dir;
        }


        // We get php source code 
        $code = file_get_contents($controller_path);

        $controller = '';

        $methods = array();

        $data = array();
        //We split our given source into PHP tokens           
        $tokens = token_get_all($code);
        $count = count($tokens);
        // We loop through the code 
        // We start from offset  2 
        for ($i = 2; $i < $count; $i++) {
            // We try to find the class name using token parser (T_CLASS)	
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $controller = $tokens[$i][1];
                // Youppie! We found a class name, so let's search for it's methods and put them in an array
                for ($j = $i; $j < $count; $j++) {
                    if ($tokens[$j - 4][0] == T_PUBLIC && $tokens[$j - 3][0] == T_WHITESPACE
                            && $tokens[$j - 2][0] == T_FUNCTION && $tokens[$j - 1][0] == T_WHITESPACE
                            && $tokens[$j][0] == T_STRING) {
                        $methods[] = strtolower($tokens[$j][1]);
                    }
                }
            }
        }
        $data[strtolower($controller)] = $methods;
        return $data;
    }

    /**
     * Get all installed modules from the upload folder
     * @author Karim Besbes
     */
    public function getNonInstalledModules() {
        $dir_content = opendir(MODULE_UPLOAD_DIR);
        $modules = array();
        while (($current_dir = readdir($dir_content)) !== false) {
            $conf = MODULE_UPLOAD_DIR . $current_dir . '/' . 'config.xml';
            if (is_file($conf) && $current_dir !== '.' && $current_dir !== '..') {
                $modules[$current_dir] = $this->parseXMLConfig($current_dir);
            }
        }
        closedir($dir_content);
        return $modules;
    }

    /**
     * Get all installed modules from the upload folder
     * @author Karim Besbes
     */
    public function getInstalledModules() {
        $dir_content = opendir(MODULES_DIR);
        $modules = array();
        while (($current_dir = readdir($dir_content)) !== false) {
            $conf = MODULES_DIR . $current_dir . '/' . 'config.xml';
            if (is_file($conf) && $current_dir !== '.' && $current_dir !== '..') {
                $modules[$current_dir] = $this->parseXMLConfig($current_dir, TRUE);
            }
        }
        closedir($dir_content);

        $m = $this->bncompta->doctrine->em->getRepository('Entities\Modules')->findAll();
        $installedModules = array();
        foreach ($m as $key) {
            if (key_exists($key->getModuleName(), $modules)) {
                array_push($installedModules, $modules[$key->getModuleName()]);
            }
        }
        return $installedModules;
    }

    public function module_check_structure($module_dir) {

        /**
         * @todo Check module structure 
         */
        $folders = array_slice(scandir($module_dir), 2);
    }

    /**
     * Parse the xml config and get module info 
     * @author Karim Besbes  
     */
    public function parseXMLConfig($module_dir, $mods_dir = FALSE) {
        $module = array();
        $xml_data = array();
        if (!$mods_dir) {
            $xml_file = MODULE_UPLOAD_DIR . $module_dir . '/config.xml';
            if (!is_file($xml_file)) {
                $xml_file = MODULES_DIR . $module_dir . '/config.xml';
            }
        }
        else
            $xml_file = MODULES_DIR . $module_dir . '/config.xml';
        $xml = simplexml_load_file($xml_file);
        if (!$xml) {
            return false;
        }
        $xml_data['name'] = $xml->attributes()->name;
        $name = (string) $xml->attributes()->name;
        foreach ($xml->children() as $child) {
            $xml_data[$child->getName()] = $child;
        }

        $module[$module_dir] = $xml_data;
        return $module;
    }

    /**
     * Method to update module data  
     * @author Karim BESBES
     * @return bool  
     */
    public function refreshModuleData($module_dir) {
        foreach (Modules::$locations as $modules_location => $val) {
            if (is_dir($modules_location . $module_dir . '/controllers')) {
                $handle = opendir($modules_location . $module_dir . '/controllers');
                while (($current_dir = readdir($handle)) !== false) {
                    if (substr($current_dir, strrpos($current_dir, '.') + 1) == 'php') {
                        $controllers[] = $current_dir;
                    }
                }
                foreach ($controllers as $controller) {
                    $controller_name = substr($controller, 0, strrpos($controller, '.'));
                    $controllers_methods[] = $this->getACLData($controller, $modules_location . $module_dir . '/controllers/');
                }
            }
        }

        return $controllers_methods;
    }

    /**
     * Parse and refresh xml for module update
     * @author Karim Besbes  
     */
    public function refresh_xml_data($module_dir) {
        foreach (Modules::$locations as $modules_location => $val) {
            if (is_file($modules_location . $module_dir . '/config.xml')) {
                $module = array();
                $xml_data = array();
                $xml_file = $modules_location . $module_dir . '/config.xml';
                $xml = simplexml_load_file($xml_file);
                if (!$xml) {
                    return false;
                }
                $xml_data['name'] = $xml->attributes()->name;
                foreach ($xml->children() as $child) {
                    $xml_data[$child->getName()] = $child;
                }
                $module[$module_dir] = $xml_data;
                return $module;
            }
        }
    }

    /**
     * Delete folder content recursively
     * @author Kairm Besbes
     */
    public function unlink_module_dir($module_dir) {
        $folders = array_slice(scandir($module_dir), 2);
        foreach ($folders as $dir) {
            $file = $module_dir . '/' . $dir;
            if (is_dir($file)) {
                $this->unlink_module_dir($file);
                @rmdir($file);
            } else {
                @unlink($file);
            }
        }
        @rmdir($module_dir);
    }

}

// return array('controller_name' => '', 'methods' => array('methode1','methode2'))

    