<?php

namespace DataBundle\Entity;

/**
 * Locations
 */
class Locations
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $langitude;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $adresse;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var string
     */
    private $codezip;

    /**
     * @var string
     */
    private $verified;

    /**
     * @var \DateTime
     */
    private $deletedat;

    /**
     * @var integer
     */
    private $public = '1';

    /**
     * @var string
     */
    private $comments;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;


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
     * Set codezip
     *
     * @param string $codezip
     *
     * @return Locations
     */
    public function setCodezip($codezip)
    {
        $this->codezip = $codezip;

        return $this;
    }

    /**
     * Get codezip
     *
     * @return string
     */
    public function getCodezip()
    {
        return $this->codezip;
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
     * Set deletedat
     *
     * @param \DateTime $deletedat
     *
     * @return Locations
     */
    public function setDeletedat($deletedat)
    {
        $this->deletedat = $deletedat;

        return $this;
    }

    /**
     * Get deletedat
     *
     * @return \DateTime
     */
    public function getDeletedat()
    {
        return $this->deletedat;
    }

    /**
     * Set public
     *
     * @param integer $public
     *
     * @return Locations
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return integer
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Locations
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
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
     * @return Locations
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

