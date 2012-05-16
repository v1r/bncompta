<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class EntitiesAclGroupsPermissionsProxy extends \Entities\AclGroupsPermissions implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function setAccessType($accessType)
    {
        $this->_load();
        return parent::setAccessType($accessType);
    }

    public function getAccessType()
    {
        $this->_load();
        return parent::getAccessType();
    }

    public function setCreatedOn($createdOn)
    {
        $this->_load();
        return parent::setCreatedOn($createdOn);
    }

    public function getCreatedOn()
    {
        $this->_load();
        return parent::getCreatedOn();
    }

    public function getId()
    {
        $this->_load();
        return parent::getId();
    }

    public function setAclResource(\Entities\AclResources $aclResource)
    {
        $this->_load();
        return parent::setAclResource($aclResource);
    }

    public function getAclResource()
    {
        $this->_load();
        return parent::getAclResource();
    }

    public function setGroup(\Entities\Groups $group)
    {
        $this->_load();
        return parent::setGroup($group);
    }

    public function getGroup()
    {
        $this->_load();
        return parent::getGroup();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'accessType', 'createdOn', 'id', 'acl_resource', 'group');
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