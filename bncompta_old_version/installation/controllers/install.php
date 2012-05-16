<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * @name Bncompta Installation steps
 * @package BNCCompta
 * @subpackage Controllers 
 * @author Karim Besbes 
 * @see http://www.bncompta.com
 * @version 0.0.1 
 * 
 *  
 * */
class Install extends CI_Controller {

    private $writeable_folder = array(
        'uploads',
        'bnc_data'
    );
    private $writeable_files = array(
        'bncompta/config/database.php'
    );

    /**
     * Constructor method
     * @access public
     * @return void
     */
    public function __construct() {
        // We call the parent controller 
        parent::__construct();
        $this->load->library('template');
        $this->template->set_theme('installer')->enable_parser(FALSE)->set_layout('default');
        $this->template->set_partial('header', 'partials/header')->set_partial('notices', 'partials/notices')->set_partial('metadata', 'partials/metadata');
        $this->template->set_partial('footer', 'partials/footer');
        $this->load->library('form_validation');
        $this->lang->load('common');
    }

    public function index() {
        redirect('install/step1');
    }

    public function step1() {
        $this->validation_config = array(
            array(
                'field' => 'host',
                'label' => 'lang:server',
                'rules' => 'trim|required|callback_test'
            ),
            array(
                'field' => 'username',
                'label' => 'lang:common_root_label',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'label' => 'lang:common_password_label',
                'rules' => 'trim'
            ),
            array(
                'field' => 'port',
                'label' => 'lang:port',
                'rules' => 'trim|required'
            )
        );
        $this->session->set_userdata(array(
            'host' => $this->input->post('host'),
            'root' => $this->input->post('username'),
            'root_password' => $this->input->post('password'),
            'port' => $this->input->post('port'),
        ));

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run()) {
            redirect('install/step2');
        } else {
            foreach ($this->validation_config as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
        }
        $this->data->repopulate = & $repopulate;
        $this->template->build('step1', $this->data);
    }

    public function step2() {
        $this->validation_config = array(
            array(
                'field' => 'database',
                'label' => 'lang:database',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'username',
                'label' => 'lang:common_username_install_label',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'email',
                'label' => 'lang:email',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'label' => 'lang:common_password_label',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'lang:common_confirm_password_label',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'firstname',
                'label' => 'lang:port',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'lastname',
                'label' => 'lang:port',
                'rules' => 'trim|required'
            )
        );
        $this->session->set_userdata(array(
            'database' => $this->input->post('database'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname')
        ));

        $this->form_validation->set_rules($this->validation_config);
        if ($this->form_validation->run()) {
            redirect('install/step3');
        } else {
            foreach ($this->validation_config as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
        }
        $this->data->repopulate = & $repopulate;
        $this->template->build('step2', $this->data);
    }

    public function step3() {

        foreach ($this->writeable_folder as $dir) {
            @chmod('../' . $dir, 0777);
            $permissions['directories'][$dir] = is_writable('../' . $dir);
        }

        foreach ($this->writeable_files as $file) {
            @chmod('../' . $file, 0666);
            $permissions['files'][$file] = is_really_writable('../' . $file);
        }

        $this->data->folders_permissions = $permissions['directories'];
        $this->data->files_permissions = $permissions['files'];

        if ($_POST) {
            /** We try to connect to the database * */
            $database = $this->session->userdata('database');
            $root = $this->session->userdata('root');
            $root_password = $this->session->userdata('root_password');
            $host = $this->session->userdata('host');
            $port = $this->session->userdata('port');
            //  Connection to the data base
            $this->db = mysql_connect($host, $root, $root_password);
            if (!$this->db) {
                die('Erreur de connexion: ' . mysql_error());
            } else {
                $selected_db = mysql_select_db($database, $this->db);
                if (!$selected_db) {
                    die('Erreur de connexion : ' . mysql_error());
                }
            }

            $db_schema = file_get_contents('./sql/bncompta_schema_v0.1.sql');
            $modules_schema = file_get_contents('./sql/bncompta_modules.sql');
            $queries = explode('/*SplitFlag*/', $db_schema);
            foreach ($queries as $query) {

                $query = rtrim(trim($query), ";");

                $result = mysql_query($query, $this->db);
                if (!$result) {
                    die('Erreur de la requete: ' . mysql_error());
                }
            }

            $query = rtrim(trim($modules_schema), ";");
            $result = mysql_query($query, $this->db);
            if (!$result) {
                die('Erreur de la requete: ' . mysql_error());
            }

            // Insert Administrator 

            $username = $this->session->userdata('username');
            $password = sha1($this->session->userdata('password'));
            $email = $this->session->userdata('email');
            $firstname = $this->session->userdata('firstname');
            $lastname = $this->session->userdata('lastname');
            $created_on = strtotime(date("H:i:s"));

            $query = "INSERT INTO users(id,email,username,password,group_id,created_on,default_lang)
              VALUES ('1','$email','$username','$password','1','$created_on','fr')";
            $result = mysql_query($query, $this->db);
            if (!$result) {
                die('Erreur de la requete: ' . mysql_error());
            } else {
                $query = "INSERT INTO users_profiles(user_id,first_name, last_name)
              VALUES ('1','$firstname', '$lastname')";
                $result = mysql_query($query, $this->db);
            }

            $database_template = file_get_contents('./database.php');

            $replace = array(
                'TEMPLATE_HOST_NAME' => $host,
                'TEMPLATE_USERNAME' => $root,
                'TEMPLATE_PASSWORD' => $root_password,
                'TEMPLATE_DATABASE' => $database,
                'TEMPLATE_PORT' => $port
            );

            $new_file = str_replace(array_keys($replace), $replace, $database_template);
            $handle = @fopen('../bncompta/config/database.php', 'w+');
            @fwrite($handle, $new_file);


            redirect('install/complete');
        }

        $this->template->build('step3', $this->data);
    }

    public function complete() {
        $complete = "complete";
        $Handle = fopen($complete, 'w') or die("erreur de la creation du fichier");
        fclose($Handle);
        $this->template->build('complete');
    }

    function test() {
        $hostname = $this->session->userdata('host');
        $username = $this->session->userdata('root');
        $password = $this->session->userdata('root_password');
        $port = $this->session->userdata('port');
        $test = @mysql_connect("$hostname:$port", $username, $password);
        if (!$test) {
            $this->form_validation->set_message('test', mysql_error());
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

