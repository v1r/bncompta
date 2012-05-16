<?php

namespace Entities;

/**
 * Entities\Modules
 */
class Modules
{
    /**
     * @var string $moduleName
     */
    private $moduleName;

    /**
     * @var string $moduleTitle
     */
    private $moduleTitle;

    /**
     * @var string $moduleDescription
     */
    private $moduleDescription;

    /**
     * @var decimal $moduleVersion
     */
    private $moduleVersion;

    /**
     * @var smallint $moduleIsCore
     */
    private $moduleIsCore;

    /**
     * @var smallint $moduleIsEnabled
     */
    private $moduleIsEnabled;

    /**
     * @var string $moduleIconPath
     */
    private $moduleIconPath;

    /**
     * @var smallint $modulePosition
     */
    private $modulePosition;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\AclResources
     */
    private $resource;

    public function __construct()
    {
        $this->resource = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set moduleName
     *
     * @param string $moduleName
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    /**
     * Get moduleName
     *
     * @return string $moduleName
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Set moduleTitle
     *
     * @param string $moduleTitle
     */
    public function setModuleTitle($moduleTitle)
    {
        $this->moduleTitle = $moduleTitle;
    }

    /**
     * Get moduleTitle
     *
     * @return string $moduleTitle
     */
    public function getModuleTitle()
    {
        return $this->moduleTitle;
    }

    /**
     * Set moduleDescription
     *
     * @param string $moduleDescription
     */
    public function setModuleDescription($moduleDescription)
    {
        $this->moduleDescription = $moduleDescription;
    }

    /**
     * Get moduleDescription
     *
     * @return string $moduleDescription
     */
    public function getModuleDescription()
    {
        return $this->moduleDescription;
    }

    /**
     * Set moduleVersion
     *
     * @param decimal $moduleVersion
     */
    public function setModuleVersion($moduleVersion)
    {
        $this->moduleVersion = $moduleVersion;
    }

    /**
     * Get moduleVersion
     *
     * @return decimal $moduleVersion
     */
    public function getModuleVersion()
    {
        return $this->moduleVersion;
    }

    /**
     * Set moduleIsCore
     *
     * @param smallint $moduleIsCore
     */
    public function setModuleIsCore($moduleIsCore)
    {
        $this->moduleIsCore = $moduleIsCore;
    }

    /**
     * Get moduleIsCore
     *
     * @return smallint $moduleIsCore
     */
    public function getModuleIsCore()
    {
        return $this->moduleIsCore;
    }

    /**
     * Set moduleIsEnabled
     *
     * @param smallint $moduleIsEnabled
     */
    public function setModuleIsEnabled($moduleIsEnabled)
    {
        $this->moduleIsEnabled = $moduleIsEnabled;
    }

    /**
     * Get moduleIsEnabled
     *
     * @return smallint $moduleIsEnabled
     */
    public function getModuleIsEnabled()
    {
        return $this->moduleIsEnabled;
    }

    /**
     * Set moduleIconPath
     *
     * @param string $moduleIconPath
     */
    public function setModuleIconPath($moduleIconPath)
    {
        $this->moduleIconPath = $moduleIconPath;
    }

    /**
     * Get moduleIconPath
     *
     * @return string $moduleIconPath
     */
    public function getModuleIconPath()
    {
        return $this->moduleIconPath;
    }

    /**
     * Set modulePosition
     *
     * @param smallint $modulePosition
     */
    public function setModulePosition($modulePosition)
    {
        $this->modulePosition = $modulePosition;
    }

    /**
     * Get modulePosition
     *
     * @return smallint $modulePosition
     */
    public function getModulePosition()
    {
        return $this->modulePosition;
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
     * Add resource
     *
     * @param Entities\AclResources $resource
     */
    public function addResource(\Entities\AclResources $resource)
    {
        $this->resource[] = $resource;
    }

    /**
     * Get resource
     *
     * @return Doctrine\Common\Collections\Collection $resource
     */
    public function getResource()
    {
        return $this->resource;
    }
}