<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * hopitaux
 *
 * @ORM\Table(name="hopitaux")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\hopitauxRepository")
 */
class hopitaux
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
     * @ORM\ManyToMany(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="hopitaux")
     * @ORM\JoinTable(
     *     name="affiliationsHospitalieres",
     *     joinColumns={@ORM\JoinColumn(name="hopital_id", referencedColumnName="id", nullable=false)},
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
     * Set name
     *
     * @param string $name
     *
     * @return hopitaux
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
     * Add doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return hopitaux
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
}
