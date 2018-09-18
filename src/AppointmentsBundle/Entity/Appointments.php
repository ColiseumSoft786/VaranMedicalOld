<?php

namespace AppointmentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointments
 *
 * @ORM\Table(name="appointments")
 * @ORM\Entity(repositoryClass="AppointmentsBundle\Repository\AppointmentsRepository")
 */
class Appointments
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
     *
     * @ORM\Column(name="seenBefor", type="boolean")
     */
    private $seenBefor;

    /**
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    /**
     *
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;


    /**
     * @ORM\ManyToOne(targetEntity="AppointmentsBundle\Entity\Reasons", inversedBy="appointments")
     * @ORM\JoinColumn(name="reason", referencedColumnName="id")
     */
    private $reason;


    /**
     * @ORM\OneToOne(targetEntity="AppointmentsBundle\Entity\Seances", inversedBy="appointment")
     * @ORM\JoinColumn(name="seance", referencedColumnName="id")
     */
    private $seance;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="appointments")
     * @ORM\JoinColumn(name="patient", referencedColumnName="id", nullable=false)
     */
    private $patient;

    /**
     *
     * @ORM\Column(name="etat", type="string")
     */
    private $etat;

    /**
     * Appointments constructor.
     * @param int $id
     */
    public function __construct()
    {
        $this->etat = 'non confirmer';
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
     * Set seenBefor
     *
     * @param boolean $seenBefor
     *
     * @return Appointments
     */
    public function setSeenBefor($seenBefor)
    {
        $this->seenBefor = $seenBefor;

        return $this;
    }

    /**
     * Get seenBefor
     *
     * @return boolean
     */
    public function getSeenBefor()
    {
        return $this->seenBefor;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Appointments
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Appointments
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set reason
     *
     * @param \AppointmentsBundle\Entity\Reasons $reason
     *
     * @return Appointments
     */
    public function setReason(\AppointmentsBundle\Entity\Reasons $reason = null)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return \AppointmentsBundle\Entity\Reasons
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set seance
     *
     * @param \AppointmentsBundle\Entity\Seances $seance
     *
     * @return Appointments
     */
    public function setSeance(\AppointmentsBundle\Entity\Seances $seance = null)
    {
        $this->seance = $seance;

        return $this;
    }

    /**
     * Get seance
     *
     * @return \AppointmentsBundle\Entity\Seances
     */
    public function getSeance()
    {
        return $this->seance;
    }

    /**
     * Set patient
     *
     * @param \UserBundle\Entity\User $patient
     *
     * @return Appointments
     */
    public function setPatient(\UserBundle\Entity\User $patient)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \UserBundle\Entity\User
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Appointments
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
