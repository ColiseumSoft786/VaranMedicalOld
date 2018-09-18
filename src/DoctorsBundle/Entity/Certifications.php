<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Certifications
 *
 * @ORM\Table(name="certifications")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\CertificationsRepository")
 */
class Certifications
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
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="occasion", type="string", nullable=false)
     */
    private $occasion;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="certifications")
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
     * Set title
     *
     * @param string $title
     *
     * @return Certifications
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set occasion
     *
     * @param string $occasion
     *
     * @return Certifications
     */
    public function setOccasion($occasion)
    {
        $this->occasion = $occasion;

        return $this;
    }

    /**
     * Get occasion
     *
     * @return string
     */
    public function getOccasion()
    {
        return $this->occasion;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Certifications
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return Certifications
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
