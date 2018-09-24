<?php

namespace DataBundle\Entity;

/**
 * Services
 */
class Services
{
    /**
     * @var string
     */
    private $service;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Specialities
     */
    private $specialitie;


    /**
     * Set service
     *
     * @param string $service
     *
     * @return Services
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
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
     * Set specialitie
     *
     * @param \DataBundle\Entity\Specialities $specialitie
     *
     * @return Services
     */
    public function setSpecialitie(\DataBundle\Entity\Specialities $specialitie = null)
    {
        $this->specialitie = $specialitie;

        return $this;
    }

    /**
     * Get specialitie
     *
     * @return \DataBundle\Entity\Specialities
     */
    public function getSpecialitie()
    {
        return $this->specialitie;
    }
}

