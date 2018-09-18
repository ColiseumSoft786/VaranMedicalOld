<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Services
 *
 * @ORM\Table(name="services")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\ServicesRepository")
 */
class Services
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
     * @ORM\Column(name="service", type="string", length=1000)
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Specialities", inversedBy="services")
     * @ORM\JoinColumn(name="specialitie_id", referencedColumnName="id")
     */
    private $specialitie;

    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\SubServices", mappedBy="service")
     */
    private $subServices;

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
     * Set service
     *
     * @param string $service
     *
     * @return Services
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }


    /**
     * Set specialitie
     *
     * @param \DoctorsBundle\Entity\Specialities $specialitie
     *
     * @return Services
     */
    public function setSpecialitie(\DoctorsBundle\Entity\Specialities $specialitie)
    {
        $this->specialitie = $specialitie;

        return $this;
    }

    /**
     * Get specialitie
     *
     * @return \DoctorsBundle\Entity\Specialities
     */
    public function getSpecialitie()
    {
        return $this->specialitie;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subServices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subService
     *
     * @param \DoctorsBundle\Entity\SubServices $subService
     *
     * @return Services
     */
    public function addSubService(\DoctorsBundle\Entity\SubServices $subService)
    {
        $this->subServices[] = $subService;

        return $this;
    }

    /**
     * Remove subService
     *
     * @param \DoctorsBundle\Entity\SubServices $subService
     */
    public function removeSubService(\DoctorsBundle\Entity\SubServices $subService)
    {
        $this->subServices->removeElement($subService);
    }

    /**
     * Get subServices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubServices()
    {
        return $this->subServices;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getService();
    }
}
