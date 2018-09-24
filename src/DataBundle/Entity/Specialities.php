<?php

namespace DataBundle\Entity;

/**
 * Specialities
 */
class Specialities
{
    /**
     * @var string
     */
    private $libelle;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Media
     */
    private $picture;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $doctor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->doctor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Specialities
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
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
     * Set picture
     *
     * @param \DataBundle\Entity\Media $picture
     *
     * @return Specialities
     */
    public function setPicture(\DataBundle\Entity\Media $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \DataBundle\Entity\Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add doctor
     *
     * @param \DataBundle\Entity\Doctors $doctor
     *
     * @return Specialities
     */
    public function addDoctor(\DataBundle\Entity\Doctors $doctor)
    {
        $this->doctor[] = $doctor;

        return $this;
    }

    /**
     * Remove doctor
     *
     * @param \DataBundle\Entity\Doctors $doctor
     */
    public function removeDoctor(\DataBundle\Entity\Doctors $doctor)
    {
        $this->doctor->removeElement($doctor);
    }

    /**
     * Get doctor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDoctor()
    {
        return $this->doctor;
    }
}

