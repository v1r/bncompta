<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class EntitiesEnterprisesClientsProxy extends \Entities\EnterprisesClients implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function setLabel($label)
    {
        $this->_load();
        return parent::setLabel($label);
    }

    public function getLabel()
    {
        $this->_load();
        return parent::getLabel();
    }

    public function setName($name)
    {
        $this->_load();
        return parent::setName($name);
    }

    public function getName()
    {
        $this->_load();
        return parent::getName();
    }

    public function setAddress($address)
    {
        $this->_load();
        return parent::setAddress($address);
    }

    public function getAddress()
    {
        $this->_load();
        return parent::getAddress();
    }

    public function setTva($tva)
    {
        $this->_load();
        return parent::setTva($tva);
    }

    public function getTva()
    {
        $this->_load();
        return parent::getTva();
    }

    public function setCiresRcs($ciresRcs)
    {
        $this->_load();
        return parent::setCiresRcs($ciresRcs);
    }

    public function getCiresRcs()
    {
        $this->_load();
        return parent::getCiresRcs();
    }

    public function setPhone($phone)
    {
        $this->_load();
        return parent::setPhone($phone);
    }

    public function getPhone()
    {
        $this->_load();
        return parent::getPhone();
    }

    public function setEmail($email)
    {
        $this->_load();
        return parent::setEmail($email);
    }

    public function getEmail()
    {
        $this->_load();
        return parent::getEmail();
    }

    public function getId()
    {
        $this->_load();
        return parent::getId();
    }

    public function addEnterprisesIncome(\Entities\EntreprisesIncomes $enterprisesIncome)
    {
        $this->_load();
        return parent::addEnterprisesIncome($enterprisesIncome);
    }

    public function getEnterprisesIncome()
    {
        $this->_load();
        return parent::getEnterprisesIncome();
    }

    public function addEnterprise(\Entities\Enterprises $enterprise)
    {
        $this->_load();
        return parent::addEnterprise($enterprise);
    }

    public function getEnterprise()
    {
        $this->_load();
        return parent::getEnterprise();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'label', 'name', 'address', 'tva', 'ciresRcs', 'phone', 'email', 'id', 'enterprises_income', 'enterprise');
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