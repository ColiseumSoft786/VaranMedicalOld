<?php

namespace AppointmentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reasons
 *
 * @ORM\Table(name="reasons")
 * @ORM\Entity(repositoryClass="AppointmentsBundle\Repository\ReasonsRepository")
 */
class Reasons
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
     * @ORM\Column(name="reason", type="string")
     */
    private $reason;

    /**
     * @ORM\OneToMany(targetEntity="AppointmentsBundle\Entity\Appointments", mappedBy="reason")
     */
    private $appointments;

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
     * Set reason
     *
     * @param string $reason
     *
     * @return Reasons
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set appointments
     *
     * @param \AppointmentsBundle\Entity\Appointments $appointments
     *
     * @return Reasons
     */
    public function setAppointments(\AppointmentsBundle\Entity\Appointments $appointments = null)
    {
        $this->appointments = $appointments;

        return $this;
    }

    /**
     * Get appointments
     *
     * @return \AppointmentsBundle\Entity\Appointments
     */
    public function getAppointment()
    {
        return $this->appointments;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getReason();
    }



    /**
     * Get appointments
     *
     * @return \AppointmentsBundle\Entity\Appointments
     */
    public function getAppointments()
    {
        return $this->appointments;
    }
}
