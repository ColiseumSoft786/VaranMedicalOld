<?php

namespace DataBundle\Entity;

/**
 * Detailstatistic
 */
class Detailstatistic
{
    /**
     * @var string
     */
    private $date;

    /**
     * @var integer
     */
    private $value;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Statistic
     */
    private $statistic;


    /**
     * Set date
     *
     * @param string $date
     *
     * @return Detailstatistic
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
     * Set value
     *
     * @param integer $value
     *
     * @return Detailstatistic
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
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
     * Set statistic
     *
     * @param \DataBundle\Entity\Statistic $statistic
     *
     * @return Detailstatistic
     */
    public function setStatistic(\DataBundle\Entity\Statistic $statistic = null)
    {
        $this->statistic = $statistic;

        return $this;
    }

    /**
     * Get statistic
     *
     * @return \DataBundle\Entity\Statistic
     */
    public function getStatistic()
    {
        return $this->statistic;
    }
}

