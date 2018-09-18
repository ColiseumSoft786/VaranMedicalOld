<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Locations
 *
 * @ORM\Table(name="locations")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\LocationsRepository")
 */
class Locations
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
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="langitude", type="string", nullable=false)
     */
    private $langitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codeZip", type="string", nullable=false)
     */
    private $codeZip;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="location")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)
     */
    private $doctor;

    /**
     * @var string
     *
     * @ORM\Column(name="verified", type="string", nullable=false)
     */
    private $verified;

    /**
     * @var string
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deleatedAt;

    /**
     * @ORM\OneToMany(targetEntity="AppointmentsBundle\Entity\Calendries", mappedBy="location")
     */
    private $calendrie;

     /**
     * @var string
     *
     * @ORM\Column(name="Comments", type="string", nullable=true)
     */
    private $Comments="";
    
    

    /**
     * Locations constructor.
     *
     */
    public function __construct()
    {
        $this->verified = 1;
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
     * Set name
     *
     * @param string $name
     *
     * @return Locations
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set langitude
     *
     * @param string $langitude
     *
     * @return Locations
     */
    public function setLangitude($langitude)
    {
        $this->langitude = $langitude;

        return $this;
    }

    /**
     * Get langitude
     *
     * @return string
     */
    public function getLangitude()
    {
        return $this->langitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Locations
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Locations
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Locations
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codeZip
     *
     * @param string $codeZip
     *
     * @return Locations
     */
    public function setCodeZip($codeZip)
    {
        $this->codeZip = $codeZip;

        return $this;
    }

    /**
     * Get codeZip
     *
     * @return string
     */
    public function getCodeZip()
    {
        return $this->codeZip;
    }

    /**
     * Set doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return Locations
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

    /**
     * Set verified
     *
     * @param string $verified
     *
     * @return Locations
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return string
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set deleatedAt
     *
     * @param \DateTime $deleatedAt
     *
     * @return Locations
     */
    public function setDeleatedAt($deleatedAt)
    {
        $this->deleatedAt = $deleatedAt;

        return $this;
    }

    /**
     * Get deleatedAt
     *
     * @return \DateTime
     */
    public function getDeleatedAt()
    {
        return $this->deleatedAt;
    }

    /**
     * Add calendrie
     *
     * @param \AppointmentsBundle\Entity\Calendries $calendrie
     *
     * @return Locations
     */
    
    
        /**
     * Set codeZip
     *
     * @param string $Comments
     *
     * @return Locations
     */
    public function setComments($Comments)
    {
        $this->Comments = $Comments;

        return $this;
    }

    /**
     * Get Comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->Comments;
    }
    
    public function addCalendrie(\AppointmentsBundle\Entity\Calendries $calendrie)
    {
        $this->calendrie[] = $calendrie;

        return $this;
    }

    /**
     * Remove calendrie
     *
     * @param \AppointmentsBundle\Entity\Calendries $calendrie
     */
    public function removeCalendrie(\AppointmentsBundle\Entity\Calendries $calendrie)
    {
        $this->calendrie->removeElement($calendrie);
    }

    /**
     * Get calendrie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCalendrie()
    {
        return $this->calendrie;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getName();
    }


}
