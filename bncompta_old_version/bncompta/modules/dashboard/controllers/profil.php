<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends Backend {

    function __construct() {
        parent::__construct();
        $this->lang->load('profil');
        $this->load->model('profil_model');
        $this->template->set_partial('navigation','tpl/profil_navigation_view');
    }

    public function index() {
        $this->data->user_profil = $this->profil_model->get_profil_informations($this->logged_in_user->user_id);
        $this->template->build('tpl/profil_view', $this->data);
    }

    public function update($section = '') {

        // Personnel information section 
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
            $user_id = $this->logged_in_user->user_id;
            if ($section == 1) {
                if ($_POST) {
                    $username = $this->input->post('username', TRUE);
                    $email = $this->input->post('email', TRUE);
                    $password = $this->input->post('password', TRUE);

                    $this->profil_model->update_account_detail($user_id, $username, $email, $password);
                }
            }
            if ($section == 2) {
                if ($_POST) {
                    $first_name = $this->input->post('first_name', TRUE);
                    $last_name = $this->input->post('last_name', TRUE);
                    $address = $this->input->post('address', TRUE);
                    $post_code = $this->input->post('post_code', TRUE);
                    $position = $this->input->post('position', TRUE);

                    $this->profil_model->update_personnel_information($user_id, $first_name, $last_name, $address, $post_code, $position);
                }
            }
            // Contact informations 
            if ($section == 3) {
                if ($_POST) {
                    $mobile_number = $this->input->post('mobile_number', TRUE);
                    $office_number = $this->input->post('office_number', TRUE);
                    $fax_number = $this->input->post('fax_number', TRUE);
                    $home_number = $this->input->post('home_number', TRUE);
                    $this->profil_model->update_contact_information($user_id, $mobile_number, $office_number, $home_number, $fax_number);
                }
            }

            if ($section == 4) {
                if ($_POST) {
                    $gravatar = $this->input->post('gravatar', TRUE);
                    $msn = $this->input->post('msn', TRUE);
                    $yahoo = $this->input->post('yahoo', TRUE);
                    $gmail = $this->input->post('gmail', TRUE);
                    $twitter = $this->input->post('twitter', TRUE);
                    $facebook = $this->input->post('facebook', TRUE);
                    $this->profil_model->update_social_information($user_id, $gravatar, $msn, $yahoo, $gmail, $twitter, $facebook);
                }
            }
        } else {
            redirect('dashboard');
            exit();
        }
    }

    public function validate_login() {
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            if (strtolower($email) == strtolower($this->logged_in_user->email))
                echo 'true';
            else {
                if ($this->kb_auth_model->login_exist($email)) {

                    echo 'false';
                }
                else
                    echo 'true';
            }
        }
        if ($this->input->post('username')) {
            $username = $this->input->post('username');
            if (strtolower($username) == strtolower($this->logged_in_user->username))
                echo 'true';
            else {
                if ($this->kb_auth_model->login_exist($username)) {
                    echo 'false';
                }
                else
                    echo 'true';
            }
        }
    }

}