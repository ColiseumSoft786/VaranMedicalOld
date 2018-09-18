<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialities
 *
 * @ORM\Table(name="specialities")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\SpecialitiesRepository")
 */
class Specialities
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
     * @ORM\Column(name="libelle", type="string", nullable=false)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Services", mappedBy="specialitie")
     */
    private $services;
    /**
     * @ORM\OneToOne(targetEntity="MediasBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="specialities")
     * @ORM\JoinTable(
     *     name="doctors_specialities",
     *     joinColumns={@ORM\JoinColumn(name="specialitie_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $doctors;

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
     * Constructor
     */
    public function __construct()
    {
        $this->doctors = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set picture
     *
     * @param \MediasBundle\Entity\Media $picture
     *
     * @return Specialities
     */
    public function setPicture(\MediasBundle\Entity\Media $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \MediasBundle\Entity\Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return Specialities
     */
    public function addDoctor(\DoctorsBundle\Entity\Doctors $doctor)
    {
        $this->doctors[] = $doctor;

        return $this;
    }

    /**
     * Remove doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     */
    public function removeDoctor(\DoctorsBundle\Entity\Doctors $doctor)
    {
        $this->doctors->removeElement($doctor);
    }

    /**
     * Get doctors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDoctors()
    {
        return $this->doctors;
    }

    function __toString()
    {
        return $this->libelle;
    }



    /**
     * Add service
     *
     * @param \DoctorsBundle\Entity\Services $service
     *
     * @return Specialities
     */
    public function addService(\DoctorsBundle\Entity\Services $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \DoctorsBundle\Entity\Services $service
     */
    public function removeService(\DoctorsBundle\Entity\Services $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
}
