<?php

namespace DoctorsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\CommentsRepository")
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks()
 */
class Comments
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
     * @ORM\Column(name="comment", type="string", nullable=false)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Locations", inversedBy="comments")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", nullable=false)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="comment")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)
     */
    private $doctor;
    
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
     * Set location
     *
     * @param \DoctorsBundle\Entity\Locations $location
     *
     * @return Comments
     */
    public function setLocation(\DoctorsBundle\Entity\Locations $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \DoctorsBundle\Entity\Locations
     */
    public function getLocation()
    {
        return $this->location;
    }
  
    /**
     * Set doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return Questions
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

