<?php

namespace Entities;

/**
 * Entities\EnterprisesAccountingYear
 */
class EnterprisesAccountingYear
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
     * @var integer $startDate
     */
    private $startDate;

    /**
     * @var integer $endDate
     */
    private $endDate;

    /**
     * @var integer $closed
     */
    private $closed;

    /**
     * @var integer $isDefault
     */
    private $isDefault;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\Enterprises
     */
    private $enterprise;


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
     * Set startDate
     *
     * @param integer $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Get startDate
     *
     * @return integer $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param integer $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Get endDate
     *
     * @return integer $endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set closed
     *
     * @param integer $closed
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
    }

    /**
     * Get closed
     *
     * @return integer $closed
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set isDefault
     *
     * @param integer $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }

    /**
     * Get isDefault
     *
     * @return integer $isDefault
     */
    public function getIsDefault()
    {
        return $this->isDefault;
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
     * @var Entities\EntreprisesIncomes
     */
    private $enterprises_income;

    public function __construct()
    {
        $this->enterprises_income = new \Doctrine\Common\Collections\ArrayCollection();
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
}