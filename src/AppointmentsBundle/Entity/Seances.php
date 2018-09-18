<?php

namespace AppointmentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seances
 *
 * @ORM\Table(name="seances")
 * @ORM\Entity(repositoryClass="AppointmentsBundle\Repository\SeancesRepository")
 */
class Seances
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
     * @ORM\Column(name="heur_debut", type="time")
     */
    private $heurDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heur_fin", type="time")
     */
    private $heurFin;

    /**
     * @var \Boolean
     *
     * @ORM\Column(name="absence", type="boolean")
     */
    private $absence;

    /**
     * @ORM\ManyToOne(targetEntity="AppointmentsBundle\Entity\Calendries", inversedBy="seances")
     * @ORM\JoinColumn(name="calendrie_id", referencedColumnName="id", nullable=false)
     */
    private $calendrie;

    /**
     * @ORM\OneToOne(targetEntity="AppointmentsBundle\Entity\Appointments", mappedBy="seance")
     */
    private $appointment;

    /**
     *
     * @ORM\Column(name="dispo", type="boolean")
     */
    private $dispo;

    /**
     * Seances constructor.
     */
    public function __construct()
    {
        $this->dispo = 1;
        $this->absence = 0;
    }


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
     * Set heurDebut
     *
     * @param \DateTime $heurDebut
     *
     * @return Seances
     */
    public function setHeurDebut($heurDebut)
    {
        $this->heurDebut = $heurDebut;

        return $this;
    }

    /**
     * Get heurDebut
     *
     * @return \DateTime
     */
    public function getHeurDebut()
    {
        return $this->heurDebut;
    }


    /**
     * Set dispo
     *
     * @param boolean $dispo
     *
     * @return Seances
     */
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;

        return $this;
    }

    /**
     * Get dispo
     *
     * @return boolean
     */
    public function getDispo()
    {
        return $this->dispo;
    }

    /**
     * Set calendrie
     *
     * @param \AppointmentsBundle\Entity\Calendries $calendrie
     *
     * @return Seances
     */
    public function setCalendrie(\AppointmentsBundle\Entity\Calendries $calendrie)
    {
        $this->calendrie = $calendrie;

        return $this;
    }

    /**
     * Get calendrie
     *
     * @return \AppointmentsBundle\Entity\Calendries
     */
    public function getCalendrie()
    {
        return $this->calendrie;
    }

    /**
     * Set appointment
     *
     * @param \AppointmentsBundle\Entity\Seances $appointment
     *
     * @return Seances
     */
    public function setAppointment(\AppointmentsBundle\Entity\Seances $appointment = null)
    {
        $this->appointment = $appointment;

        return $this;
    }

    /**
     * Get appointment
     *
     * @return \AppointmentsBundle\Entity\Seances
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return 'seance'.$this->getId();
    }



    /**
     * Set absence
     *
     * @param boolean $absence
     *
     * @return Seances
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
     * Set heurFin
     *
     * @param \DateTime $heurFin
     *
     * @return Seances
     */
    public function setHeurFin($heurFin)
    {
        $this->heurFin = $heurFin;

        return $this;
    }

    /**
     * Get heurFin
     *
     * @return \DateTime
     */
    public function getHeurFin()
    {
        return $this->heurFin;
    }
}
