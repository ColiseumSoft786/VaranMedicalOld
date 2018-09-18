<?php

namespace DataBundle\Entity;

/**
 * Invoices
 */
class Invoices
{
    /**
     * @var string
     */
    private $price;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;

    /**
     * @var \DataBundle\Entity\SubServices
     */
    private $subservice;


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
     * @return Invoices
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

    /**
     * Set subservice
     *
     * @param \DataBundle\Entity\SubServices $subservice
     *
     * @return Invoices
     */
    public function setSubservice(\DataBundle\Entity\SubServices $subservice = null)
    {
        $this->subservice = $subservice;

        return $this;
    }

    /**
     * Get subservice
     *
     * @return \DataBundle\Entity\SubServices
     */
    public function getSubservice()
    {
        return $this->subservice;
    }
}
