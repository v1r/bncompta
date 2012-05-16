<?php

namespace Entities;

/**
 * Entities\Groups
 */
class Groups
{
    /**
     * @var string $groupName
     */
    private $groupName;

    /**
     * @var string $groupDescription
     */
    private $groupDescription;

    /**
     * @var string $interfacePrefix
     */
    private $interfacePrefix;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\Users
     */
    private $users;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set groupName
     *
     * @param string $groupName
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    /**
     * Get groupName
     *
     * @return string $groupName
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * Set groupDescription
     *
     * @param string $groupDescription
     */
    public function setGroupDescription($groupDescription)
    {
        $this->groupDescription = $groupDescription;
    }

    /**
     * Get groupDescription
     *
     * @return string $groupDescription
     */
    public function getGroupDescription()
    {
        return $this->groupDescription;
    }

    /**
     * Set interfacePrefix
     *
     * @param string $interfacePrefix
     */
    public function setInterfacePrefix($interfacePrefix)
    {
        $this->interfacePrefix = $interfacePrefix;
    }

    /**
     * Get interfacePrefix
     *
     * @return string $interfacePrefix
     */
    public function getInterfacePrefix()
    {
        return $this->interfacePrefix;
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
     * Add users
     *
     * @param Entities\Users $users
     */
    public function addUsers(\Entities\Users $users)
    {
        $this->users[] = $users;
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection $users
     */
    public function getUsers()
    {
        return $this->users;
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
}