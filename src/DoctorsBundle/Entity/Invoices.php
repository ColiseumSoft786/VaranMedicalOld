<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoices
 *
 * @ORM\Table(name="invoices")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\InvoicesRepository")
 */
class Invoices
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
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\SubServices", inversedBy="invoices")
     * @ORM\JoinColumn(name="subService_id", referencedColumnName="id", nullable=false)
     */
    private $subService;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Doctors", inversedBy="invoices")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)
     */
    private $doctor;
    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string")
     */
    private $price;

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
     * Set price
     *
     * @param string $price
     *
     * @return Invoices
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set subService
     *
     * @param \DoctorsBundle\Entity\SubServices $subService
     *
     * @return Invoices
     */
    public function setSubService(\DoctorsBundle\Entity\SubServices $subService)
    {
        $this->subService = $subService;

        return $this;
    }

    /**
     * Get subService
     *
     * @return \DoctorsBundle\Entity\SubServices
     */
    public function getSubService()
    {
        return $this->subService;
    }

    /**
     * Set doctor
     *
     * @param \DoctorsBundle\Entity\Doctors $doctor
     *
     * @return Invoices
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
