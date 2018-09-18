<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Educations
 *
 * @ORM\Table(name="educations")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\EducationsRepository")
 */
class Educations
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
     * @var string
     *
     * @ORM\Column(name="typeOfSchool", type="string", nullable=true)
     */
    private $typeOfSchool;

    /**
     * @var string
     *
     * @ORM\Column(name="school", type="string", nullable=false)
     */
    private $school;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="education")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)
     */
    private $doctor;

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
     * Set typeOfSchool
     *
     * @param string $typeOfSchool
     *
     * @return Educations
     */
    public function setTypeOfSchool($typeOfSchool)
    {
        $this->typeOfSchool = $typeOfSchool;

        return $this;
    }

    /**
     * Get typeOfSchool
     *
     * @return string
     */
    public function getTypeOfSchool()
    {
        return $this->typeOfSchool;
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
     * Set doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return Educations
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
