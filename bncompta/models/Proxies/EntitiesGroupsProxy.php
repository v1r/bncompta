<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class EntitiesGroupsProxy extends \Entities\Groups implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    private function _load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    
    public function setGroupName($groupName)
    {
        $this->_load();
        return parent::setGroupName($groupName);
    }

    public function getGroupName()
    {
        $this->_load();
        return parent::getGroupName();
    }

    public function setGroupDescription($groupDescription)
    {
        $this->_load();
        return parent::setGroupDescription($groupDescription);
    }

    public function getGroupDescription()
    {
        $this->_load();
        return parent::getGroupDescription();
    }

    public function setInterfacePrefix($interfacePrefix)
    {
        $this->_load();
        return parent::setInterfacePrefix($interfacePrefix);
    }

    public function getInterfacePrefix()
    {
        $this->_load();
        return parent::getInterfacePrefix();
    }

    public function getId()
    {
        $this->_load();
        return parent::getId();
    }

    public function addUsers(\Entities\Users $users)
    {
        $this->_load();
        return parent::addUsers($users);
    }

    public function getUsers()
    {
        $this->_load();
        return parent::getUsers();
    }

    public function addGroupPermission(\Entities\AclGroupsPermissions $groupPermission)
    {
        $this->_load();
        return parent::addGroupPermission($groupPermission);
    }

    public function getGroupPermission()
    {
        $this->_load();
        return parent::getGroupPermission();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'groupName', 'groupDescription', 'interfacePrefix', 'id', 'users', 'group_permission');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}