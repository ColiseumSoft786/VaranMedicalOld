<?php

namespace DataBundle\Entity;

/**
 * Horaire
 */
class Horaire
{
    /**
     * @var \DateTime
     */
    private $heureDebut;

    /**
     * @var \DateTime
     */
    private $heureFin;

    /**
     * @var string
     */
    private $jour;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Locations
     */
    private $location;


    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return Horaire
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return Horaire
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set jour
     *
     * @param string $jour
     *
     * @return Horaire
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
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
     * Set location
     *
     * @param \DataBundle\Entity\Locations $location
     *
     * @return Horaire
     */
    public function setLocation(\DataBundle\Entity\Locations $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \DataBundle\Entity\Locations
     */
    public function getLocation()
    {
        return $this->location;
    }
}
