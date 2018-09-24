<?php

namespace DataBundle\Entity;

/**
 * Unblockph
 */
class Unblockph
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;

    /**
     * @var \DataBundle\Entity\Publicholiday
     */
    private $ph;


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
     * @return Unblockph
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

    /**
     * Set ph
     *
     * @param \DataBundle\Entity\Publicholiday $ph
     *
     * @return Unblockph
     */
    public function setPh(\DataBundle\Entity\Publicholiday $ph = null)
    {
        $this->ph = $ph;

        return $this;
    }

    /**
     * Get ph
     *
     * @return \DataBundle\Entity\Publicholiday
     */
    public function getPh()
    {
        return $this->ph;
    }
}

