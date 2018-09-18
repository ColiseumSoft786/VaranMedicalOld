<?php

namespace DataBundle\Entity;

/**
 * Publicholiday
 */
class Publicholiday
{
    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Admin
     */
    private $admin;


    /**
     * Set date
     *
     * @param string $date
     *
     * @return Publicholiday
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Publicholiday
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
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
     * @return Publicholiday
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
