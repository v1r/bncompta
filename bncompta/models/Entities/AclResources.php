<?php

namespace Entities;

/**
 * Entities\AclResources
 */
class AclResources
{
    /**
     * @var string $resourceIdentifer
     */
    private $resourceIdentifer;

    /**
     * @var string $resourceDescription
     */
    private $resourceDescription;

    /**
     * @var string $resourceType
     */
    private $resourceType;

    /**
     * @var integer $createdOn
     */
    private $createdOn;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\AclActions
     */
    private $actions;

    /**
     * @var Entities\Modules
     */
    private $module;

    public function __construct()
    {
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set resourceIdentifer
     *
     * @param string $resourceIdentifer
     */
    public function setResourceIdentifer($resourceIdentifer)
    {
        $this->resourceIdentifer = $resourceIdentifer;
    }

    /**
     * Get resourceIdentifer
     *
     * @return string $resourceIdentifer
     */
    public function getResourceIdentifer()
    {
        return $this->resourceIdentifer;
    }

    /**
     * Set resourceDescription
     *
     * @param string $resourceDescription
     */
    public function setResourceDescription($resourceDescription)
    {
        $this->resourceDescription = $resourceDescription;
    }

    /**
     * Get resourceDescription
     *
     * @return string $resourceDescription
     */
    public function getResourceDescription()
    {
        return $this->resourceDescription;
    }

    /**
     * Set resourceType
     *
     * @param string $resourceType
     */
    public function setResourceType($resourceType)
    {
        $this->resourceType = $resourceType;
    }

    /**
     * Get resourceType
     *
     * @return string $resourceType
     */
    public function getResourceType()
    {
        return $this->resourceType;
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
     * Add actions
     *
     * @param Entities\AclActions $actions
     */
    public function addActions(\Entities\AclActions $actions)
    {
        $this->actions[] = $actions;
    }

    /**
     * Get actions
     *
     * @return Doctrine\Common\Collections\Collection $actions
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set module
     *
     * @param Entities\Modules $module
     */
    public function setModule(\Entities\Modules $module)
    {
        $this->module = $module;
    }

    /**
     * Get module
     *
     * @return Entities\Modules $module
     */
    public function getModule()
    {
        return $this->module;
    }
    /**
     * @var Entities\AclGroupsPermissions
     */
    private $group_permission;


    /**
     * Add group_permission
     *
     * @param Entities\AclGroupsPermissions $groupPermission
     */
    public function addGroupPermission(\Entities\AclGroupsPermissions $groupPermission)
    {
        $this->group_permission[] = $groupPermission;
    }

    /**
     * Get group_permission
     *
     * @return Doctrine\Common\Collections\Collection $groupPermission
     */
    public function getGroupPermission()
    {
        return $this->group_permission;
    }
    /**
     * @var Entities\AclEnterprisesPermissions
     */
    private $enterprise_permission;


    /**
     * Add enterprise_permission
     *
     * @param Entities\AclEnterprisesPermissions $enterprisePermission
     */
    public function addEnterprisePermission(\Entities\AclEnterprisesPermissions $enterprisePermission)
    {
        $this->enterprise_permission[] = $enterprisePermission;
    }

    /**
     * Get enterprise_permission
     *
     * @return Doctrine\Common\Collections\Collection $enterprisePermission
     */
    public function getEnterprisePermission()
    {
        return $this->enterprise_permission;
    }
}