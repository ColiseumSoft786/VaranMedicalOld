<?php

namespace DataBundle\Entity;

/**
 * Reasons
 */
class Reasons
{
    /**
     * @var string
     */
    private $reason;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Reasons
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
}

