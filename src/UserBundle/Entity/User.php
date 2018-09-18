<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $typeUser
     *
     * @ORM\Column(name="typeUser", type="string", length=255, nullable=true)
     */
    private $typeUser;

    /**
     * @var int $idTable
     *
     * @ORM\Column(name="idTable", type="integer", nullable=true)
     */
    private $idTable;

    /**
     * @ORM\OneToMany(targetEntity="AppointmentsBundle\Entity\Appointments", mappedBy="patient")
     */
    private $appointments;

    /**
     * @ORM\OneToMany(targetEntity="MediasBundle\Entity\Media", mappedBy="user")
     */
    private $photos;
    /**
     * @var int $idTable
     *
     * @ORM\Column(name="verifier", type="integer", nullable=true)
     */
    private $verifier;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set typeUser
     *
     * @param string $typeUser
     *
     * @return User
     */
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    /**
     * Get typeUser
     *
     * @return string
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * Set idTable
     *
     * @param integer $idTable
     *
     * @return User
     */
    public function setIdTable($idTable)
    {
        $this->idTable = $idTable;

        return $this;
    }

    /**
     * Get idTable
     *
     * @return integer
     */
    public function getIdTable()
    {
        return $this->idTable;
    }

    /**
     * Set verifier
     *
     * @param integer $verifier
     *
     * @return User
     */
    public function setVerifier($verifier)
    {
        $this->verifier = $verifier;

        return $this;
    }

    /**
     * Get verifier
     *
     * @return integer
     */
    public function getVerifier()
    {
        return $this->verifier;
    }

    /**
     * Add photo
     *
     * @param \MediasBundle\Entity\Media $photo
     *
     * @return User
     */
    public function addPhoto(\MediasBundle\Entity\Media $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \MediasBundle\Entity\Media $photo
     */
    public function removePhoto(\MediasBundle\Entity\Media $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add appointment
     *
     * @param \AppointmentsBundle\Entity\Appointments $appointment
     *
     * @return User
     */
    public function addAppointment(\AppointmentsBundle\Entity\Appointments $appointment)
    {
        $this->appointments[] = $appointment;

        return $this;
    }

    /**
     * Remove appointment
     *
     * @param \AppointmentsBundle\Entity\Appointments $appointment
     */
    public function removeAppointment(\AppointmentsBundle\Entity\Appointments $appointment)
    {
        $this->appointments->removeElement($appointment);
    }

    /**
     * Get appointments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppointments()
    {
        return $this->appointments;
    }
}
