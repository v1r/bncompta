<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

/**
 * 
 * Codeigniter module forge library comptaible with HMVC  
 * Forge your module now!
 * @author Karim BESBES - BNCompta Dev Team
 * @package BNCOMPTA
 * @category Modules
 * @version v0.2
 * @created on 18/06/2011
 * @Modified on 06/07/2011
 */
class Module_forge {

    /**
     * CodeIgniter global
     * @var string
     * */
    protected $ci;

    /**
     * construct
     * @return void
     * */
    public function __construct() {
        $this->ci = & get_instance();
    }

    /**
     * Function to check module dir exist or not
     * @author Karim BESBES
     * @access private
     * @return bool 
     */
    public function module_dir_exist($raw_name = '') {
        foreach ($this->ci->modules_location as $key) {
            $dir = './' . $key;
        }
        if (is_dir($dir)) {
            $dir_content = opendir($dir);
            while (($current_dir = readdir($dir_content)) !== false) {
                if ($current_dir == $raw_name) {
                    return true;
                }
            }
            closedir($dir_content);
        }
        return false;
    }

    /**
     * Get all installed modules from the upload folder
     * @author Karim Besbes
     */
    public function get_not_installed_modules() {
        $dir_content = opendir('uploads');
        $modules = array();
        while (($current_dir = readdir($dir_content)) !== false) {
            if (is_file('uploads/' . $current_dir . '/' . 'config.xml') && $current_dir !== '.')
                $modules[$current_dir] = $this->parse_xml_config($current_dir);
        }
        closedir($dir_content);
        return $modules;
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
    public function parse_xml_config($module_dir) {
        $module = array();
        $xml_data = array();
        $xml_file = 'uploads/' . $module_dir . '/config.xml';
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

    /**
     * Get controllers names
     * @author Karim Besbes
     */
    public function get_module_controllers($module_dir) {
        $controller_dir = 'uploads/' . $module_dir . '/controllers';
        $files = array();
        $handle = opendir($controller_dir);
        while (($current_dir = readdir($handle)) !== false) {
            if (substr($current_dir, strrpos($current_dir, '.') + 1) == 'php') {
                $files[] = $current_dir;
            }
        }
        return $files;
    }

    /**
     * Method to Refresh class data for module update
     * @author Karim BESBES
     * @return bool  
     */
    public function refresh_class_data($module_dir) {
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
                    $controllers_methods[] = $this->get_module_class_data($controller, $modules_location . $module_dir . '/controllers/');
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
     * Get controller name and methods
     * @author Karim BESBES
     * @return array 
     */
    public function get_module_class_data($controller, $path) {
        $controller_path = $path . $controller;
        // We get php source code 
        $code = file_get_contents($controller_path);
        $controller = '';
        $methods = array();
        $data = array();
        //We split our given source into PHP tokens           
        $tokens = token_get_all($code);
        $count = count($tokens);
        // We loop through the code 
        // try to dump $code to understund why 2 :) 
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

    /**
     * Prepare module data 
     * @author Karim Besbes
     */
    public function prepare_data($module_name, $data, $controllers_methods, $type ='') {

        $title = array();
        $description = array();
        $module_data = array();
        foreach ($data as $key) {
            $module_data['name'] = (string) $key['name'];
            $module_data['version'] = (string) $key['version'];
            $module_data['menu'] = (string) $key['menu'];
            $module_data['enabled'] = (int) $key['enabled'];
            $module_data['type'] = (string) $key['type'];
            $module_data['is_core'] = (int) $key['is_core'];
            $module_data['home_controller'] = (int) $key['home_controller'];
            $module_data['lang_file_name'] = (string) $key['lang_file_name'];
            $module_data['has_settings'] = (int) $key['has_settings'];
            $module_data['icon_path'] = (string) $key['icon_path'];
            foreach ($key['title'] as $k => $v) {

                $title[$k] = (string) $v;
            }

            foreach ($key['description'] as $k => $v) {
                $description[$k] = (string) $v;
            }
        }
        if ($type == '') {
            if ($this->ci->mods_model->install($module_data, $title, $description, $controllers_methods)) {
                return true;
            }
        } else if ($type == 'refresh') {
            if ($this->ci->mods_model->update($module_name, $module_data, $title, $description, $controllers_methods)) {
                return true;
            }
        }
    }
}
// return array('controller_name' => '', 'methods' => array('methode1','methode2'))

    