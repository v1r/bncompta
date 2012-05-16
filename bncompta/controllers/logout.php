<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * 
 * @name Logout  
 * @package BNCCompta
 * @subpackage Controllers 
 * @author Karim Besbes 
 * @see http://www.karimbesbes.com   
 * @version 0.0.1 
 * 
 *  
 * */
class Logout extends BNCOMPTA_Controller {

    /**
     * Constructor method
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Display the control panel
     * @access public
     * @return void
     */
    public function index() {
        $this->core->auth->logout();
        redirect('logout/redirect');
    }

    public function test() {

        // $this->core->acl->addGroupPermission('upload', 1, 'GRANTED');
        //echo $user->getGroups()->getGroupDescription();
    }

    public function doctrine() {

        $g = new Entities\Groups;
        $u = new Entities\Users;


        $g = $this->doctrine->em->getRepository('Entities\Groups')->findById(2);


        $u->setUsername('karim2');
        $u->setCreatedOn(now());
        $u->setDefaultLang('fr');
        $u->setEmail('contact@karimbesbes.com');
        $u->setGroups($g[0]);
        $u->setLastLoginOn(now());
        $u->setLastOnlineOn(now());
        $u->setPassword(sha1('karim'));

        $this->doctrine->em->persist($u);
        $this->doctrine->em->flush();
        $e = new Entities\Enterprises;
        $e->setUser($u);
        $e->setEnterpriseLabel('Enterprise  final');
        $e->setEnterpriseIsAga(1);
        $e->setCreatedOn(now());

        $this->doctrine->em->persist($e);
        $this->doctrine->em->flush();

        $ep = new Entities\EnterprisesProfiles;
        $ep->setEnterpriseProfile($e);
        $ep->setName('Enterprise de marketing test3');
        $ep->setDescription("on s'en fou");
        $ep->setCity('canada');
        $ep->setCountry('');
        $ep->setLogoPath('');
        $ep->setHomePage('');
        $ep->setSiret('');
        $ep->setFaxNumber('');
        $ep->setTva('');
        $ep->setUpdatedOn(now());
        $ep->setIsTva(0);
        $ep->setCreatedOn(now());
        $ep->setTurnOver(0);
        $ep->setCountry('');
        $ep->setPhoneNumber('');

        $this->doctrine->em->persist($ep);
        $this->doctrine->em->flush();

        $e->setProfile($ep);

        $this->doctrine->em->persist($e);
        $this->doctrine->em->flush();
    }

    public function redirect() {
        $this->session->set_flashdata('success_message', 'OMG THIS IS WORKING');
        redirect('auth/login');
    }

}