<?php

namespace DataBundle\Entity;

/**
 * Holidaysadmin
 */
class Holidaysadmin
{
    /**
     * @var string
     */
    private $day;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Admin
     */
    private $admin;


    /**
     * Set day
     *
     * @param string $day
     *
     * @return Holidaysadmin
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
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
     * Set admin
     *
     * @param \DataBundle\Entity\Admin $admin
     *
     * @return Holidaysadmin
     */
    public function setAdmin(\DataBundle\Entity\Admin $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \DataBundle\Entity\Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}

