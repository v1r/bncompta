<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Enterprises Controller 
 * 
 * @author Karim Besbes - BNCompta dev team
 * @package CP
 * @subpackage Entreprises module 
 * @copyright Copyright (c) 2011, BNCompta
 * @category Entreprises module
 * @since Version 0.1
 * 
 * */
class cpEnterprisesController extends CP_Controller {

    function __construct() {
        parent::__construct();

        (is_ajax()) ? $this->template->set_layout(FALSE) : '';
        $this->template->set_partial('navigation', 'build/navigation/navigation_view');
    }

    public function index() {

        $enterprises = $this->doctrine->em->getRepository('Entities\Enterprises')->findALL();
     
     $this->template->build('tpl/entreprise_list', $this->data);
    }

    public function addAction() {


        if (post_request("submit")) {
            $enterprise = new Entities\Enterprises;
            $eProfile = new Entities\EnterprisesProfiles;
            $aclEnterprise = new Entities\AclEnterprisesPermissions;
            $enterprise->setEnterpriseLabel(post_request('label', TRUE));
            $enterprise->setEnterpriseIsAga(0);
            $enterprise->setCreatedOn(now());
            $this->doctrine->em->persist($enterprise);
            $this->doctrine->em->flush();
            $eProfile->setDescription(post_request('label', TRUE));
            $eProfile->setName(post_request('name', TRUE));
            $eProfile->setCity('');
            $eProfile->setCountry('');
            $eProfile->setCreatedOn(now());
            $eProfile->setDescription(post_request('description', TRUE));
            $eProfile->setEnterprise($enterprise);
            $eProfile->setFaxNumber('');
            $eProfile->setHomePage('');
            $eProfile->setIsTva(0);
            $eProfile->setLogoPath('');
            $eProfile->setPhoneNumber('');
            $eProfile->setTurnOver('');
            $eProfile->setSiret('');
            $eProfile->setTva(0);
            $eProfile->setUpdatedOn(now());
            $this->doctrine->em->persist($eProfile);
            $this->doctrine->em->flush();
            $enterprise->setProfile($eProfile);
            $this->doctrine->em->persist($enterprise);
            $this->doctrine->em->flush();
            foreach (post_request('modules') as $key => $resource_id) {

                $resource = $this->doctrine->em->getRepository('Entities\AclResources')->findById($resource_id);

                $aclEnterprise->setAccessType(Acl::ACCESS_GRANTED);
                $aclEnterprise->setAclResource($resource[0]);
                $aclEnterprise->setCreatedOn(now());
                $aclEnterprise->setEnterprise($enterprise);
                $this->doctrine->em->persist($aclEnterprise);
                $this->doctrine->em->flush();
                unset($aclEnterprise);
                unset($resource);
            }
            unset($enterprise);
            unset($eProfile);
        }

        $modules = $this->doctrine->em->getRepository('Entities\AclResources')
                ->findBy(array('resourceType' => 'mp'));
        $this->data->modules = array();

        foreach ($modules as $key) {
            $this->data->modules[$key->getResourceIdentifer()]->resource_id = $key->getId();
            $this->data->modules[$key->getResourceIdentifer()]->description = $key->getResourceDescription();
        }

        unset($modules);

        $this->template->build('build/cp/enterprise_add_form_view', $this->data);
    }

    public function assign($entreprise_id, $manager_id) {
        $this->entreprise_model->remove_entreprise_manager($entreprise_id);
        $this->entreprise_model->assign_mananger($entreprise_id, $manager_id);
        $this->session->set_flashdata('success', lang('entreprise_manager_assigned'));
        redirect('entreprises/manage');
    }

    public function edit($entreprise_id) {
        if ($_POST) {
            if ($this->form_validation->run('add_entreprise') !== FALSE) {
                $data = array(
                    'label' => underscore($this->input->post('label')),
                    'description' => $this->input->post('description'),
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    'modules' => $this->input->post('modules')
                );

                if ($this->entreprise_model->update_entreprise($data, $entreprise_id)) {
                    $this->session->set_flashdata('success', lang('success_message'));
                } else {
                    $this->session->set_flashdata('error', lang('error_message'));
                }
                foreach ($this->config->item('accounting_year') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
                redirect('entreprises/manage');
            } else {

                foreach ($this->config->item('add_entreprise') as $validation) {
                    $repopulate->{$validation['field']} = set_value($validation['field']);
                }
                $this->data->repopulate = & $repopulate;
            }
        } else {
            $repopulate = $this->entreprise_model->get_entreprise_data($entreprise_id);
            $this->data->repopulate = $repopulate[0];
        }
        $this->data->mod_entreprise = $mod_entreprise = unserialize($this->entreprise_model->get_entreprise_modules_by_id($entreprise_id));
        $this->data->entreprise_mdoules = $entreprise_mdoules = $this->entreprise_model->get_entreprise_modules();
        $this->template->build('tpl/edit_entreprise_view');
    }

    public function ajax_update() {

        $entreprise_id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $description = $this->input->post('description');
        $this->entreprise_model->update_entreprise($name, $email, $description, $entreprise_id);
    }

    function ajax_notifications() {
        $data = array('notify' => ' Hi karim',
            'notify1' => 'besbes',
            'notify2' => ' Hi karim1',
            'notify3' => ' Hi karim2',
            'notify4' => ' Hi kari3m',
            'notify5' => ' Hi karrim',
            'notify6' => ' Hi kariem',
            'notify7' => ' Hi karrim',
            'notify8' => ' Hi karewim',
            'notify9' => ' Hi karirem',
            'notify10' => ' Hi karreim',
            'notify11' => ' Hi kadgrim',
            'notify12' => ' Hi kargfdim',
            'notify13' => ' Hi karfdsgim',
            'notify14' => ' Hi karsfdgsfim',
            'notify15' => ' Hi kasgrim',
            'notify16' => ' Hi kdaarim',
            'notify17' => ' Hi kaadsfrim',
        );

        $data_ = json_encode($data);
        echo $data;
        echo json_decode('{"notify0":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 0","notify1":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 1","notify2":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 2","notify3":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 3","notify4":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 4","notify5":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 5","notify6":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 6","notify7":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 7","notify8":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 8","notify9":"test dsfa sdfasd fasd fadsf dasf das fdsaf adsf dafad fasd asd fsda fdsaf asfsad fdas f af a 9"}');
    }

}