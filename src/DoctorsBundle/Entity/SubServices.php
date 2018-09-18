<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubServices
 *
 * @ORM\Table(name="sub_services")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\SubServicesRepository")
 */
class SubServices
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
     * @ORM\Column(name="subService", type="string", length=1000)
     */
    private $subService;

    /**
     * @ORM\ManyToOne(targetEntity="DoctorsBundle\Entity\Services", inversedBy="subServices")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id", nullable=false)
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Invoices", mappedBy="subService")
     */
    private $invoices;
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
     * Set subService
     *
     * @param string $subService
     *
     * @return SubServices
     */
    public function setSubService($subService)
    {
        $this->subService = $subService;

        return $this;
    }

    /**
     * Get subService
     *
     * @return string
     */
    public function getSubService()
    {
        return $this->subService;
    }

    /**
     * Set service
     *
     * @param \DoctorsBundle\Entity\Services $service
     *
     * @return SubServices
     */
    public function setService(\DoctorsBundle\Entity\Services $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \DoctorsBundle\Entity\Services
     */
    public function getService()
    {
        return $this->service;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    

    /**
     * Add invoice
     *
     * @param \DoctorsBundle\Entity\Invoices $invoice
     *
     * @return SubServices
     */
    public function addInvoice(\DoctorsBundle\Entity\Invoices $invoice)
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * Remove invoice
     *
     * @param \DoctorsBundle\Entity\Invoices $invoice
     */
    public function removeInvoice(\DoctorsBundle\Entity\Invoices $invoice)
    {
        $this->invoices->removeElement($invoice);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getSubService();
    }


}
