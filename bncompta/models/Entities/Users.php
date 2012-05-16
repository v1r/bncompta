<?php

namespace Entities;

/**
 * Entities\Users
 */
class Users
{
    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $defaultLang
     */
    private $defaultLang;

    /**
     * @var integer $lastLoginOn
     */
    private $lastLoginOn;

    /**
     * @var integer $lastOnlineOn
     */
    private $lastOnlineOn;

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
    private $enterprise;

    /**
     * @var Entities\Groups
     */
    private $groups;

    public function __construct()
    {
        $this->enterprise = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set defaultLang
     *
     * @param string $defaultLang
     */
    public function setDefaultLang($defaultLang)
    {
        $this->defaultLang = $defaultLang;
    }

    /**
     * Get defaultLang
     *
     * @return string $defaultLang
     */
    public function getDefaultLang()
    {
        return $this->defaultLang;
    }

    /**
     * Set lastLoginOn
     *
     * @param integer $lastLoginOn
     */
    public function setLastLoginOn($lastLoginOn)
    {
        $this->lastLoginOn = $lastLoginOn;
    }

    /**
     * Get lastLoginOn
     *
     * @return integer $lastLoginOn
     */
    public function getLastLoginOn()
    {
        return $this->lastLoginOn;
    }

    /**
     * Set lastOnlineOn
     *
     * @param integer $lastOnlineOn
     */
    public function setLastOnlineOn($lastOnlineOn)
    {
        $this->lastOnlineOn = $lastOnlineOn;
    }

    /**
     * Get lastOnlineOn
     *
     * @return integer $lastOnlineOn
     */
    public function getLastOnlineOn()
    {
        return $this->lastOnlineOn;
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

    /**
     * Set groups
     *
     * @param Entities\Groups $groups
     */
    public function setGroups(\Entities\Groups $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Get groups
     *
     * @return Entities\Groups $groups
     */
    public function getGroups()
    {
        return $this->groups;
    }
    /**
     * @var Entities\AclUsersPermissions
     */
    private $acl_user_permission;


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
}