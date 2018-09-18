<?php

namespace DataBundle\Entity;

/**
 * Appointments
 */
class Appointments
{
    /**
     * @var boolean
     */
    private $seenbefor;

    /**
     * @var string
     */
    private $note;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\FosUser
     */
    private $patient;

    /**
     * @var \DataBundle\Entity\Reasons
     */
    private $reason;

    /**
     * @var \DataBundle\Entity\Seances
     */
    private $seance;


    /**
     * Set seenbefor
     *
     * @param boolean $seenbefor
     *
     * @return Appointments
     */
    public function setSeenbefor($seenbefor)
    {
        $this->seenbefor = $seenbefor;

        return $this;
    }

    /**
     * Get seenbefor
     *
     * @return boolean
     */
    public function getSeenbefor()
    {
        return $this->seenbefor;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Appointments
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Appointments
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Appointments
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
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
     * Set patient
     *
     * @param \DataBundle\Entity\FosUser $patient
     *
     * @return Appointments
     */
    public function setPatient(\DataBundle\Entity\FosUser $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \DataBundle\Entity\FosUser
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set reason
     *
     * @param \DataBundle\Entity\Reasons $reason
     *
     * @return Appointments
     */
    public function setReason(\DataBundle\Entity\Reasons $reason = null)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return \DataBundle\Entity\Reasons
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set seance
     *
     * @param \DataBundle\Entity\Seances $seance
     *
     * @return Appointments
     */
    public function setSeance(\DataBundle\Entity\Seances $seance = null)
    {
        $this->seance = $seance;

        return $this;
    }

    /**
     * Get seance
     *
     * @return \DataBundle\Entity\Seances
     */
    public function getSeance()
    {
        return $this->seance;
    }
}
