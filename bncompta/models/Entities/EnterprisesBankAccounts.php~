<?php

namespace Entities;

/**
 * Entities\EnterprisesBankAccounts
 */
class EnterprisesBankAccounts
{
    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $address
     */
    private $address;

    /**
     * @var string $rib
     */
    private $rib;

    /**
     * @var string $iban
     */
    private $iban;

    /**
     * @var string $bic
     */
    private $bic;

    /**
     * @var string $contact
     */
    private $contact;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var integer $id
     */
    private $id;


    /**
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set rib
     *
     * @param string $rib
     */
    public function setRib($rib)
    {
        $this->rib = $rib;
    }

    /**
     * Get rib
     *
     * @return string $rib
     */
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * Set iban
     *
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * Get iban
     *
     * @return string $iban
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set bic
     *
     * @param string $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * Get bic
     *
     * @return string $bic
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * Set contact
     *
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get contact
     *
     * @return string $contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var Entities\EnterprisesBankStatements
     */
    private $enterprises_bank_statements;

    /**
     * @var Entities\Enterprises
     */
    private $enterprise;

    public function __construct()
    {
        $this->enterprises_bank_statements = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add enterprises_bank_statements
     *
     * @param Entities\EnterprisesBankStatements $enterprisesBankStatements
     */
    public function addEnterprisesBankStatements(\Entities\EnterprisesBankStatements $enterprisesBankStatements)
    {
        $this->enterprises_bank_statements[] = $enterprisesBankStatements;
    }

    /**
     * Get enterprises_bank_statements
     *
     * @return Doctrine\Common\Collections\Collection $enterprisesBankStatements
     */
    public function getEnterprisesBankStatements()
    {
        return $this->enterprises_bank_statements;
    }

    /**
     * Set enterprise
     *
     * @param Entities\Enterprises $enterprise
     */
    public function setEnterprise(\Entities\Enterprises $enterprise)
    {
        $this->enterprise = $enterprise;
    }

    /**
     * Get enterprise
     *
     * @return Entities\Enterprises $enterprise
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }
}