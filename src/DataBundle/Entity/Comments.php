<?php

namespace DataBundle\Entity;

/**
 * Comments
 */
class Comments
{
    /**
     * @var string
     */
    private $comment;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Locations
     */
    private $location;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;


    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Comments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
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
     * @return Comments
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

    /**
     * Set doctor
     *
     * @param \DataBundle\Entity\Doctors $doctor
     *
     * @return Comments
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
