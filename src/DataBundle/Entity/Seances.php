<?php

namespace DataBundle\Entity;

/**
 * Seances
 */
class Seances
{
    /**
     * @var \DateTime
     */
    private $heurDebut;

    /**
     * @var boolean
     */
    private $dispo;

    /**
     * @var boolean
     */
    private $absence;

    /**
     * @var \DateTime
     */
    private $heurFin;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Calendries
     */
    private $calendrie;


    /**
     * Set heurDebut
     *
     * @param \DateTime $heurDebut
     *
     * @return Seances
     */
    public function setHeurDebut($heurDebut)
    {
        $this->heurDebut = $heurDebut;

        return $this;
    }

    /**
     * Get heurDebut
     *
     * @return \DateTime
     */
    public function getHeurDebut()
    {
        return $this->heurDebut;
    }

    /**
     * Set dispo
     *
     * @param boolean $dispo
     *
     * @return Seances
     */
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;

        return $this;
    }

    /**
     * Get dispo
     *
     * @return boolean
     */
    public function getDispo()
    {
        return $this->dispo;
    }

    /**
     * Set absence
     *
     * @param boolean $absence
     *
     * @return Seances
     */
    public function setAbsence($absence)
    {
        $this->absence = $absence;

        return $this;
    }

    /**
     * Get absence
     *
     * @return boolean
     */
    public function getAbsence()
    {
        return $this->absence;
    }

    /**
     * Set heurFin
     *
     * @param \DateTime $heurFin
     *
     * @return Seances
     */
    public function setHeurFin($heurFin)
    {
        $this->heurFin = $heurFin;

        return $this;
    }

    /**
     * Get heurFin
     *
     * @return \DateTime
     */
    public function getHeurFin()
    {
        return $this->heurFin;
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
     * Set calendrie
     *
     * @param \DataBundle\Entity\Calendries $calendrie
     *
     * @return Seances
     */
    public function setCalendrie(\DataBundle\Entity\Calendries $calendrie = null)
    {
        $this->calendrie = $calendrie;

        return $this;
    }

    /**
     * Get calendrie
     *
     * @return \DataBundle\Entity\Calendries
     */
    public function getCalendrie()
    {
        return $this->calendrie;
    }
}

