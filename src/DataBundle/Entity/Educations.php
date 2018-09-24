<?php

namespace DataBundle\Entity;

/**
 * Educations
 */
class Educations
{
    /**
     * @var string
     */
    private $typeofschool;

    /**
     * @var string
     */
    private $school;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;


    /**
     * Set typeofschool
     *
     * @param string $typeofschool
     *
     * @return Educations
     */
    public function setTypeofschool($typeofschool)
    {
        $this->typeofschool = $typeofschool;

        return $this;
    }

    /**
     * Get typeofschool
     *
     * @return string
     */
    public function getTypeofschool()
    {
        return $this->typeofschool;
    }

    /**
     * Set school
     *
     * @param string $school
     *
     * @return Educations
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
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
     * @return Educations
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

