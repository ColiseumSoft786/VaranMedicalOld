<?php

namespace AppointmentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="AppointmentsBundle\Repository\SettingsRepository")
 */
class Settings
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
     * @ORM\Column(name="durreAppointment", type="time")
     */
    private $durreAppointment;

    /**
     * @ORM\OneToOne(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="settings")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)
     */
    private $doctor;

    /**
     * Settings constructor.
     *
     */
    public function __construct()
    {
        $durreAppointment = (new \DateTime('00:30:00'));
        $this->durreAppointment = $durreAppointment;
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
     * Set durreAppointment
     *
     * @param \DateTime $durreAppointment
     *
     * @return Settings
     */
    public function setDurreAppointment($durreAppointment)
    {
        $this->durreAppointment = $durreAppointment;

        return $this;
    }

    /**
     * Get durreAppointment
     *
     * @return \DateTime
     */
    public function getDurreAppointment()
    {
        return $this->durreAppointment;
    }

    /**
     * Set doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return Settings
     */
    public function setDoctor(\DoctorsBundle\Entity\Doctors $doctor)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get doctor
     *
     * @return \DoctorsBundle\Entity\Doctors
     */
    public function getDoctor()
    {
        return $this->doctor;
    }
}
