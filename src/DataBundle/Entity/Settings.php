<?php

namespace DataBundle\Entity;

/**
 * Settings
 */
class Settings
{
    /**
     * @var \DateTime
     */
    private $durreappointment;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;


    /**
     * Set durreappointment
     *
     * @param \DateTime $durreappointment
     *
     * @return Settings
     */
    public function setDurreappointment($durreappointment)
    {
        $this->durreappointment = $durreappointment;

        return $this;
    }

    /**
     * Get durreappointment
     *
     * @return \DateTime
     */
    public function getDurreappointment()
    {
        return $this->durreappointment;
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
     * Set doctor
     *
     * @param \DataBundle\Entity\Doctors $doctor
     *
     * @return Settings
     */
    public function setDoctor(\DataBundle\Entity\Doctors $doctor = null)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get doctor
     *
     * @return \DataBundle\Entity\Doctors
     */
    public function getDoctor()
    {
        return $this->doctor;
    }
}
