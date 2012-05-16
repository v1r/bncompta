<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 *  BNCOMPTA
 *  @package BNCOMPTA Access List Control
 *  @author Karim BESBES - BNCOMPTADev Team 
 *  @copyright Copyright(c) 2011 2012
 *  @license 
 *  @since  Version 0.1
 */

/**
 *    
 */
class Acl {

    private $bncompta;

    const ACCESS_DENIED = "DENIED";
    const ACCESS_GRANTED = "GRANTED";
    const GROUP_ACCESS = "ga";
    const CUSTOM_ACCESS = "ca";

    private $_userId;
    private $_groupId;
    private $_interface;
    private $_accessType;
    protected $_acl = array(
        'accessType' => 'both',
        'byGA' => array(
            'modules' => array(
        )),
        'byCA' => array(
            'modules' => array()
            ));

    function __construct($config) {

        // Local reference bncompta super object
        $this->bncompta = & get_instance();
        $this->_acl = $config;
    }

    public function initACL($data) {
        $this->_userId = $data->user_id;
        $this->_groupId = $data->group_id;

        $query = $this->bncompta->doctrine->em->createQuery("
            SELECT g FROM Entities\Groups g
            JOIN g.group_permission gp
            WHERE gp.group = :group_id");

        $query->setParameters(array(
            'group_id' => $this->_groupId
        ));

        if (!$query) {
            return FALSE;
        }

        $group = $query->getResult();
        if ($group) {
            $group_permission = $group[0]->getGroupPermission();
            foreach ($group_permission as $key => $value) {
                $module = $value->getAclResource()->getModule()->getModuleName();
                $resource = $value->getAclResource()->getResourceIdentifer();
                $this->_acl['byGA'][$module][$resource]["accessType"] = $value->getAccessType();
            }
        }   

        unset($group);
        return $this->_acl;

        // $this->revokeGroupAccess(1,1 ,self::ACCESS_DENIED);
        //$this->checkAcess('modules', 'cpmodulescontroller');
    }

    public function checkAcess($moduleIdentifier, $resourceIdentifier, $actionIdentifier = FALSE) {

        if (!key_exists($moduleIdentifier, $this->_acl['byGA'])) {
            show_error("You dont have the permission to access this module");
            dump($this->_acl);
        } else {
            if (!key_exists($resourceIdentifier, $this->_acl['byGA'][$moduleIdentifier])) {
                show_error("You dont have the permission to access this resource");
            } else {

                if ($this->_acl['byGA'][$moduleIdentifier][$resourceIdentifier]['accessType'] === self::ACCESS_DENIED)
                    show_error("You dont have the permission to access this resource");
                else
                    show_error("Access granted");
            }
        }
    }

    public function grantGroupAccess($resourceIdentifier, $groupId, $accessType = self::ACCESS_GRANTED) {

        $gp = $this->bncompta->doctrine->em->getRepository('Entities\AclGroupsPermissions')
                ->findOneBy(array('group' => $groupId, 'acl_resource' => $resourceIdentifier));
        $gp->setAccessType($accessType);
        $this->bncompta->doctrine->em->persist($gp);
        $this->bncompta->doctrine->em->flush();
        unset($gp);
    }

    public function revokeGroupAccess($resourceIdentifier, $groupId, $accessType = self::ACCESS_DENIED) {
        $gp = $this->bncompta->doctrine->em->getRepository('Entities\AclGroupsPermissions')
                ->findOneBy(array('group' => $groupId, 'acl_resource' => $resourceIdentifier));
        $gp->setAccessType($accessType);
        $this->bncompta->doctrine->em->persist($gp);
        $this->bncompta->doctrine->em->flush();
        unset($gp);
    }

    public function addGroupPermission($resource_identifer, $group_id, $access_type = self::ACCESS_DENIED) {


        $r = $resource = new Entities\AclResources;

        $gp = $group_permission = new Entities\AclGroupsPermissions;

        $g = $group = new Entities\Groups;

        $r = $this->bncompta->doctrine->em->getRepository('Entities\AclResources')->findByResourceIdentifer($resource_identifer);


        $g = $this->bncompta->doctrine->em->getRepository('Entities\Groups')->findById($group_id);
        if (empty($r[0]))
            show_error("Resource not found ");
        if (empty($g[0]))
            show_error("Group Id not found ");

        $gp->setGroup($g[0]);

        $gp->setAclResource($r[0]);

        $gp->setAccessType($access_type);

        $gp->setCreatedOn(now());

        $this->bncompta->doctrine->em->persist($gp);
        $this->bncompta->doctrine->em->flush();
        unset($r);
        unset($gp);
        unset($g);
    }

    public function addUserPermission($action_id, $user_id, $access_type = ACCESS_DENIED) {


        $a = $action = new Entities\AclActions;

        $up = $user_permission = new Entities\AclUsersPermissions;

        $a = $this->bncompta->doctrine->em->getRepository('Entities\AclActions')->findById($action_id);

        $u = $this->bncompta->doctrine->em->getRepository('Entities\Users')->findById($user_id);


        if (empty($a[0]))
            show_error("Action not found ");
        if (empty($u[0]))
            show_error("user Id not found ");

        $up->setAclAction($a[0]);

        $up->setUser($u[0]);

        $up->setAccessType($access_type);

        $up->setCreatedOn(now());

        $this->bncompta->doctrine->em->persist($up);
        $this->bncompta->doctrine->em->flush();
        unset($a);
        unset($up);
        unset($u);
    }

    public function removeGroupePermission($resource_id, $group_id) {
        
    }

    public function check_access($module = '', $class = '', $method = '') {
        
    }

}

