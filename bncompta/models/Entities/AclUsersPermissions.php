<?php

namespace Entities;

/**
 * Entities\AclUsersPermissions
 */
class AclUsersPermissions
{
    /**
     * @var string $accessType
     */
    private $accessType;

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
    private $acl_action;

    /**
     * @var Entities\Users
     */
    private $user;


    /**
     * Set accessType
     *
     * @param string $accessType
     */
    public function setAccessType($accessType)
    {
        $this->accessType = $accessType;
    }

    /**
     * Get accessType
     *
     * @return string $accessType
     */
    public function getAccessType()
    {
        return $this->accessType;
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
     * Set acl_action
     *
     * @param Entities\AclActions $aclAction
     */
    public function setAclAction(\Entities\AclActions $aclAction)
    {
        $this->acl_action = $aclAction;
    }

    /**
     * Get acl_action
     *
     * @return Entities\AclActions $aclAction
     */
    public function getAclAction()
    {
        return $this->acl_action;
    }

    /**
     * Set user
     *
     * @param Entities\Users $user
     */
    public function setUser(\Entities\Users $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Entities\Users $user
     */
    public function getUser()
    {
        return $this->user;
    }
}