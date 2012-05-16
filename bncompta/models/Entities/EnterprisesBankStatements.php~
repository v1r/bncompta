<?php

namespace Entities;

/**
 * Entities\EnterprisesBankStatements
 */
class EnterprisesBankStatements
{
    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var integer $date
     */
    private $date;

    /**
     * @var float $ammount
     */
    private $ammount;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\EntreprisesIncomes
     */
    private $enterprises_income;

    /**
     * @var Entities\Enterprises
     */
    private $enterprise;

    /**
     * @var Entities\EnterprisesBankAccounts
     */
    private $enterprises_bank_accounts;

    public function __construct()
    {
        $this->enterprises_income = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set date
     *
     * @param integer $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return integer $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set ammount
     *
     * @param float $ammount
     */
    public function setAmmount($ammount)
    {
        $this->ammount = $ammount;
    }

    /**
     * Get ammount
     *
     * @return float $ammount
     */
    public function getAmmount()
    {
        return $this->ammount;
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

    /**
     * Set enterprises_bank_accounts
     *
     * @param Entities\EnterprisesBankAccounts $enterprisesBankAccounts
     */
    public function setEnterprisesBankAccounts(\Entities\EnterprisesBankAccounts $enterprisesBankAccounts)
    {
        $this->enterprises_bank_accounts = $enterprisesBankAccounts;
    }

    /**
     * Get enterprises_bank_accounts
     *
     * @return Entities\EnterprisesBankAccounts $enterprisesBankAccounts
     */
    public function getEnterprisesBankAccounts()
    {
        return $this->enterprises_bank_accounts;
    }
}