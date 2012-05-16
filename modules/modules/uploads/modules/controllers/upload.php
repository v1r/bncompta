<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Karim BESBES
 * @description Bncompta Module forge
 * @created 24/06/2011
 * @updated 28/06/2011
 */
class Upload extends Backend {

    function __construct() {
        parent::__construct();
        $this->load->library('unzip');
        $this->load->library('module_forge');
        $this->template->set_partial('navigation', 'tpl/navigation_view');
        (is_ajax()) ? $this->template->set_layout(FALSE) : '';
        if ($this->ajax_nav)
            $this->template->append_static_view('game1/tpl/admin/navigation_view');
        else
            $this->template->set_partial('navigation', 'tpl/admin/navigation_view');
    }

    public function index() {
        if ($this->session->userdata('upload_errors'))
            $this->data->error = $this->session->userdata('upload_errors');
  
        $this->template->build('tpl/upload_form', $this->data);
    }

    public function upload_process() {
        $config['upload_path'] = UPLOADIR;
        $config['allowed_types'] = '*';
        $config['max_size'] = '2048';
        $config['max_width'] = '1024';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $this->data->error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata('upload_errors', $this->data->error);
            
            redirect($this->redirect_module);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $raw_name = $data['upload_data']['raw_name'];
            $zip_path = 'uploads/' . $data['upload_data']['file_name'];
            mkdir(UPLOADIR . $data['upload_data']['raw_name'], 0777);
            $tmp = 'uploads/' . $data['upload_data']['raw_name'];
            $dir = $data['upload_data']['raw_name'];
            $this->unzip->extract($data['upload_data']['full_path'], $tmp);

            $this->unzip->close();
            $uploaded_module_data = $this->module_forge->parse_xml_config($dir);
            if (!$uploaded_module_data) {
                $this->session->set_flashdata('error', lang('module_bad_xml_structure'));
                $this->_clear_dir($tmp);
                exit;
            }

            $raw_module_name = $uploaded_module_data[$raw_name]['name'];
            $errors = '';

            if (strlen((string) $raw_module_name) == 0) {
                $this->session->set_flashdata('error', lang('module_undefined_module_name'));
                $this->_clear_dir($tmp);
                exit;
            } else if ($this->module_forge->module_dir_exist($raw_module_name)) {
                $this->session->set_flashdata('error', lang('module_name_already_exist'));
                $this->_clear_dir($tmp);
                exit;
            }
            //$this->module_forge->module_check_structure($tmp);
            // $errors .= lang('module_bad_folder_structure');
            //$this->_clear_dir($tmp); 

            redirect('modules/manage');
        }
    }

    /**
     * Delete unwanted modules 
     */
    private function _clear_dir($dir) {
        $this->module_forge->unlink_module_dir($dir);
        redirect('modules/manage');
    }

}