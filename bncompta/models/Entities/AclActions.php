<?php

namespace Entities;

/**
 * Entities\AclActions
 */
class AclActions
{
    /**
     * @var string $actionIdentifer
     */
    private $actionIdentifer;

    /**
     * @var string $actionDescription
     */
    private $actionDescription;

    /**
     * @var smallint $role_order
     */
    private $role_order;

    /**
     * @var integer $createdOn
     */
    private $createdOn;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\AclUsersPermissions
     */
    private $acl_user_permission;

    /**
     * @var Entities\AclResources
     */
    private $resources;

    public function __construct()
    {
        $this->acl_user_permission = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set actionIdentifer
     *
     * @param string $actionIdentifer
     */
    public function setActionIdentifer($actionIdentifer)
    {
        $this->actionIdentifer = $actionIdentifer;
    }

    /**
     * Get actionIdentifer
     *
     * @return string $actionIdentifer
     */
    public function getActionIdentifer()
    {
        return $this->actionIdentifer;
    }

    /**
     * Set actionDescription
     *
     * @param string $actionDescription
     */
    public function setActionDescription($actionDescription)
    {
        $this->actionDescription = $actionDescription;
    }

    /**
     * Get actionDescription
     *
     * @return string $actionDescription
     */
    public function getActionDescription()
    {
        return $this->actionDescription;
    }

    /**
     * Set role_order
     *
     * @param smallint $roleOrder
     */
    public function setRoleOrder($roleOrder)
    {
        $this->role_order = $roleOrder;
    }

    /**
     * Get role_order
     *
     * @return smallint $roleOrder
     */
    public function getRoleOrder()
    {
        return $this->role_order;
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
     * Add acl_user_permission
     *
     * @param Entities\AclUsersPermissions $aclUserPermission
     */
    public function addAclUserPermission(\Entities\AclUsersPermissions $aclUserPermission)
    {
        $this->acl_user_permission[] = $aclUserPermission;
    }

    /**
     * Get acl_user_permission
     *
     * @return Doctrine\Common\Collections\Collection $aclUserPermission
     */
    public function getAclUserPermission()
    {
        return $this->acl_user_permission;
    }

    /**
     * Set resources
     *
     * @param Entities\AclResources $resources
     */
    public function setResources(\Entities\AclResources $resources)
    {
        $this->resources = $resources;
    }

    /**
     * Get resources
     *
     * @return Entities\AclResources $resources
     */
    public function getResources()
    {
        return $this->resources;
    }
}