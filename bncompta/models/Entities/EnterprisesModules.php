<?php

namespace Entities;

/**
 * Entities\EnterprisesModules
 */
class EnterprisesModules
{
    /**
     * @var string $modules
     */
    private $modules;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Entities\Enterprises
     */
    private $enterprise;


    /**
     * Set modules
     *
     * @param string $modules
     */
    public function setModules($modules)
    {
        $this->modules = $modules;
    }

    /**
     * Get modules
     *
     * @return string $modules
     */
    public function getModules()
    {
        return $this->modules;
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
}