<?php

namespace AppointmentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendries
 *
 * @ORM\Table(name="calendries")
 * @ORM\Entity(repositoryClass="AppointmentsBundle\Repository\CalendriesRepository")
 */
class Calendries
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;


    /**
     * @ORM\OneToMany(targetEntity="AppointmentsBundle\Entity\Seances", mappedBy="calendrie")
     */
    private $seances;

    /**
     * @var \Boolean
     *
     * @ORM\Column(name="public", type="boolean")
     */
    private $public;

    /**
     * @var \Boolean
     *
     * @ORM\Column(name="absence", type="boolean")
     */
    private $absence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleatedAt", type="datetime", nullable=true)
     */
    private $deleatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Locations", inversedBy="calendrie")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", nullable=false)
     */
    private $location;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seances = new \Doctrine\Common\Collections\ArrayCollection();
        $this->active = 0;
        $this->public = 0;
        $this->absence = 0;
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
     * Set deleatedAt
     *
     * @param \DateTime $deleatedAt
     *
     * @return Calendries
     */
    public function setDeleatedAt($deleatedAt)
    {
        $this->deleatedAt = $deleatedAt;

        return $this;
    }

    /**
     * Get deleatedAt
     *
     * @return \DateTime
     */
    public function getDeleatedAt()
    {
        return $this->deleatedAt;
    }

    /**
     * Add seance
     *
     * @param \AppointmentsBundle\Entity\Seances $seance
     *
     * @return Calendries
     */
    public function addSeance(\AppointmentsBundle\Entity\Seances $seance)
    {
        $this->seances[] = $seance;

        return $this;
    }

    /**
     * Remove seance
     *
     * @param \AppointmentsBundle\Entity\Seances $seance
     */
    public function removeSeance(\AppointmentsBundle\Entity\Seances $seance)
    {
        $this->seances->removeElement($seance);
    }

    /**
     * Get seances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeances()
    {
        return $this->seances;
    }

    /**
     * Set location
     *
     * @param \DoctorsBundle\Entity\Locations $location
     *
     * @return Calendries
     */
    public function setLocation(\DoctorsBundle\Entity\Locations $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \DoctorsBundle\Entity\Locations
     */
    public function getLocation()
    {
        return $this->location;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return "id of calendar : ".$this->getId();
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
}
