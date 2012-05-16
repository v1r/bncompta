<?php

namespace Entities;

/**
 * Entities\EnterprisesClients
 */
class EnterprisesClients
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
     * @var float $tva
     */
    private $tva;

    /**
     * @var string $ciresRcs
     */
    private $ciresRcs;

    /**
     * @var string $phone
     */
    private $phone;

    /**
     * @var string $email
     */
    private $email;

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
     * Set tva
     *
     * @param float $tva
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    }

    /**
     * Get tva
     *
     * @return float $tva
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set ciresRcs
     *
     * @param string $ciresRcs
     */
    public function setCiresRcs($ciresRcs)
    {
        $this->ciresRcs = $ciresRcs;
    }

    /**
     * Get ciresRcs
     *
     * @return string $ciresRcs
     */
    public function getCiresRcs()
    {
        return $this->ciresRcs;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
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
     * @var Entities\EntreprisesIncomes
     */
    private $enterprises_income;

    /**
     * @var Entities\Enterprises
     */
    private $enterprise;

    public function __construct()
    {
        $this->enterprises_income = new \Doctrine\Common\Collections\ArrayCollection();
    $this->enterprise = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add enterprises_income
     *
     * @param Entities\EntreprisesIncomes $enterprisesIncome
     */
    public function addEnterprisesIncome(\Entities\EntreprisesIncomes $enterprisesIncome)
    {
        $this->enterprises_income[] = $enterprisesIncome;
    }

    /**
     * Get enterprises_income
     *
     * @return Doctrine\Common\Collections\Collection $enterprisesIncome
     */
    public function getEnterprisesIncome()
    {
        return $this->enterprises_income;
    }

    /**
     * Add enterprise
     *
     * @param Entities\Enterprises $enterprise
     */
    public function addEnterprise(\Entities\Enterprises $enterprise)
    {
        $this->enterprise[] = $enterprise;
    }

    /**
     * Get enterprise
     *
     * @return Doctrine\Common\Collections\Collection $enterprise
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }
}