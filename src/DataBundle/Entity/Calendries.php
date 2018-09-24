<?php

namespace DataBundle\Entity;

/**
 * Calendries
 */
class Calendries
{
    /**
     * @var \DateTime
     */
    private $deleatedat;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $public;

    /**
     * @var boolean
     */
    private $absence;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Locations
     */
    private $location;


    /**
     * Set deleatedat
     *
     * @param \DateTime $deleatedat
     *
     * @return Calendries
     */
    public function setDeleatedat($deleatedat)
    {
        $this->deleatedat = $deleatedat;

        return $this;
    }

    /**
     * Get deleatedat
     *
     * @return \DateTime
     */
    public function getDeleatedat()
    {
        return $this->deleatedat;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Calendries
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set public
     *
     * @param boolean $public
     *
     * @return Calendries
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set absence
     *
     * @param boolean $absence
     *
     * @return Calendries
     */
    public function setAbsence($absence)
    {
        $this->absence = $absence;

        return $this;
    }

    /**
     * Get absence
     *
     * @return boolean
     */
    public function getAbsence()
    {
        return $this->absence;
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
     * Set location
     *
     * @param \DataBundle\Entity\Locations $location
     *
     * @return Calendries
     */
    public function setLocation(\DataBundle\Entity\Locations $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \DataBundle\Entity\Locations
     */
    public function getLocation()
    {
        return $this->location;
    }
}

