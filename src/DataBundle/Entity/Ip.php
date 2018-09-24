<?php

namespace DataBundle\Entity;

/**
 * Ip
 */
class Ip
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var integer
     */
    private $user;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set address
     *
     * @param string $address
     *
     * @return Ip
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Ip
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
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
}

