<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting {

    protected $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('settings/settings_model');
    }

    public function __get($name) {
        return self::get($name);
    }

    public function __set($name, $value) {
        return self::set($name, $value);
    }

    public function get($name) {

         return $this->ci->settings_model->get_setting_value($name);
    }
    public function set($name, $value) {

         return $this->ci->settings_model->set_setting_value($name, $value);
    }

}
?>