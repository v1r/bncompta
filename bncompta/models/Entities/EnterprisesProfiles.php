<?php

namespace Entities;

/**
 * Entities\EnterprisesProfiles
 */
class EnterprisesProfiles
{
    /**
     * @var float $turnOver
     */
    private $turnOver;

    /**
     * @var string $siret
     */
    private $siret;

    /**
     * @var smallint $isTva
     */
    private $isTva;

    /**
     * @var string $tva
     */
    private $tva;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var string $homePage
     */
    private $homePage;

    /**
     * @var string $logoPath
     */
    private $logoPath;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var string $phoneNumber
     */
    private $phoneNumber;

    /**
     * @var string $faxNumber
     */
    private $faxNumber;

    /**
     * @var integer $updatedOn
     */
    private $updatedOn;

    /**
     * @var integer $createdOn
     */
    private $createdOn;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\Enterprises
     */
    private $enterprise_profile;


    /**
     * Set turnOver
     *
     * @param float $turnOver
     */
    public function setTurnOver($turnOver)
    {
        $this->turnOver = $turnOver;
    }

    /**
     * Get turnOver
     *
     * @return float $turnOver
     */
    public function getTurnOver()
    {
        return $this->turnOver;
    }

    /**
     * Set siret
     *
     * @param string $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * Get siret
     *
     * @return string $siret
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set isTva
     *
     * @param smallint $isTva
     */
    public function setIsTva($isTva)
    {
        $this->isTva = $isTva;
    }

    /**
     * Get isTva
     *
     * @return smallint $isTva
     */
    public function getIsTva()
    {
        return $this->isTva;
    }

    /**
     * Set tva
     *
     * @param string $tva
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    }

    /**
     * Get tva
     *
     * @return string $tva
     */
    public function getTva()
    {
        return $this->tva;
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
     * Set homePage
     *
     * @param string $homePage
     */
    public function setHomePage($homePage)
    {
        $this->homePage = $homePage;
    }

    /**
     * Get homePage
     *
     * @return string $homePage
     */
    public function getHomePage()
    {
        return $this->homePage;
    }

    /**
     * Set logoPath
     *
     * @param string $logoPath
     */
    public function setLogoPath($logoPath)
    {
        $this->logoPath = $logoPath;
    }

    /**
     * Get logoPath
     *
     * @return string $logoPath
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Get phoneNumber
     *
     * @return string $phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set faxNumber
     *
     * @param string $faxNumber
     */
    public function setFaxNumber($faxNumber)
    {
        $this->faxNumber = $faxNumber;
    }

    /**
     * Get faxNumber
     *
     * @return string $faxNumber
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * Set updatedOn
     *
     * @param integer $updatedOn
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
    }

    /**
     * Get updatedOn
     *
     * @return integer $updatedOn
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set createdOn
     *
     * @param integer $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * Get createdOn
     *
     * @return integer $createdOn
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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
     * Set enterprise_profile
     *
     * @param Entities\Enterprises $enterpriseProfile
     */
    public function setEnterpriseProfile(\Entities\Enterprises $enterpriseProfile)
    {
        $this->enterprise_profile = $enterpriseProfile;
    }

    /**
     * Get enterprise_profile
     *
     * @return Entities\Enterprises $enterpriseProfile
     */
    public function getEnterpriseProfile()
    {
        return $this->enterprise_profile;
    }
    /**
     * @var Entities\Enterprises
     */
    private $enterprise;


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