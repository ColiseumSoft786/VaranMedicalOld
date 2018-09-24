<?php

namespace DataBundle\Entity;

/**
 * Dp
 */
class Dp
{
    /**
     * @var integer
     */
    private $block;

    /**
     * @var string
     */
    private $review;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;

    /**
     * @var \DataBundle\Entity\Patient
     */
    private $patient;


    /**
     * Set block
     *
     * @param integer $block
     *
     * @return Dp
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return integer
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set review
     *
     * @param string $review
     *
     * @return Dp
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
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
     * @return Dp
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
     * Set patient
     *
     * @param \DataBundle\Entity\Patient $patient
     *
     * @return Dp
     */
    public function setPatient(\DataBundle\Entity\Patient $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \DataBundle\Entity\Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }
}

