<?php

namespace DataBundle\Entity;

/**
 * SubServices
 */
class SubServices
{
    /**
     * @var string
     */
    private $subservice;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Services
     */
    private $service;


    /**
     * Set subservice
     *
     * @param string $subservice
     *
     * @return SubServices
     */
    public function setSubservice($subservice)
    {
        $this->subservice = $subservice;

        return $this;
    }

    /**
     * Get subservice
     *
     * @return string
     */
    public function getSubservice()
    {
        return $this->subservice;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set service
     *
     * @param \DataBundle\Entity\Services $service
     *
     * @return SubServices
     */
    public function setService(\DataBundle\Entity\Services $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \DataBundle\Entity\Services
     */
    public function getService()
    {
        return $this->service;
    }
}

