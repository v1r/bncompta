<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!class_exists('CI_Model')) {

    class CI_Model extends Model {
        
    }

}

/**
 * 
 *  @author Karim Besbes
 *  @version v0.0.1 
 *  @name Permissions model
 *  
 *  Created on 09/06/11
 *  Last Modification : 10/06/11 
 */
class Mods_model extends CI_Model {

    /**
     * @author Karim Besbes
     * @return string 
     */
    public function get_module_by_id($module_id) {
        return $this->db->select()->where('id', $module_id)->get('modules')->row();
    }

    public function get_module_id($module_name) {
        return $this->db->select()->where('name', $module_name)->get('modules')->row()->id;
    }

    public function get_module_name_by_id($module_id) {
        return $this->db->select()->where('id', $module_id)->get('modules')->row()->name;
    }

    public function get_all_modules() {
        $modules = new ArrayObject();
        foreach ($this->db->order_by("position", "asc")->get('modules')->result() as $row) {

            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'title' => $row->title,
                'description' => $row->description,
                'menu' => $row->menu,
                'type' => $row->type,
                'is_core' => $row->is_core,
                'has_settings' => $row->has_settings,
                'home_controller' => $row->home_controller,
                'version' => $row->version,
                'enabled' => $row->enabled,
                'class_data' => $row->controllers,
                'icon_path' => $row->icon_path,
                'lang_file_name' => $row->lang_file_name,
            );

            $module_data = new ArrayObject($data, ArrayObject::ARRAY_AS_PROPS);
            $modules[$module_data['name']] = $module_data;
        }

        return $modules;
    }

    public function install($module_data, $title, $description, $controller_methods) {
        return $this->db->insert('modules', array(
            'name' => $module_data['name'],
            'version' => $module_data['version'],
            'menu' => $module_data['menu'],
            'type' => $module_data['type'],
            'enabled' => $module_data['enabled'],
            'is_core' => $module_data['is_core'],
            'has_settings' => $module_data['has_settings'],
            'home_controller' => $module_data['home_controller'],
            'lang_file_name' => $module_data['lang_file_name'],
            'icon_path' => $module_data['icon_path'],
            'title' => serialize($title),
            'description' => serialize($description),
            'controllers' => serialize($controller_methods)));
    }

    public function update($module, $module_data, $title, $description, $controller_methods) {
        $this->db->where('name', $module)
                ->update('modules', array(
                    'version' => $module_data['version'],
                    'menu' => $module_data['menu'],
                    'type' => $module_data['type'],
                    'enabled' => $module_data['enabled'],
                    'is_core' => $module_data['is_core'],
                    'has_settings' => $module_data['has_settings'],
                    'home_controller' => $module_data['home_controller'],
                    'lang_file_name' => $module_data['lang_file_name'],
                    'icon_path' => $module_data['icon_path'],
                    'title' => serialize($title),
                    'description' => serialize($description),
                    'controllers' => serialize($controller_methods)
                ));
        return true;
    }

    public function activate_module($module_id) {
        $data = array('enabled' => 1);
        return $this->db->where('id', $module_id)->update('modules', $data);
    }

    public function desactivate_module($module_id) {
        $data = array('enabled' => 0);
        return $this->db->where('id', $module_id)->update('modules', $data);
    }

    public function update_module_position($module_name, $new_position) {

        $this->db->where('name', $module_name)->update('modules', array('position' => $new_position));
    }

}
