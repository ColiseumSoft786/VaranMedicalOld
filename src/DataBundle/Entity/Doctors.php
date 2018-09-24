<?php

namespace DataBundle\Entity;

/**
 * Doctors
 */
class Doctors
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var \DateTime
     */
    private $birthday;

    /**
     * @var string
     */
    private $gsm;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $professionalStatement;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $views = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $hopital;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $specialitie;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hopital = new \Doctrine\Common\Collections\ArrayCollection();
        $this->specialitie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Doctors
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Doctors
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Doctors
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set gsm
     *
     * @param string $gsm
     *
     * @return Doctors
     */
    public function setGsm($gsm)
    {
        $this->gsm = $gsm;

        return $this;
    }

    /**
     * Get gsm
     *
     * @return string
     */
    public function getGsm()
    {
        return $this->gsm;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Doctors
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set professionalStatement
     *
     * @param string $professionalStatement
     *
     * @return Doctors
     */
    public function setProfessionalStatement($professionalStatement)
    {
        $this->professionalStatement = $professionalStatement;

        return $this;
    }

    /**
     * Get professionalStatement
     *
     * @return string
     */
    public function getProfessionalStatement()
    {
        return $this->professionalStatement;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Doctors
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Doctors
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set views
     *
     * @param integer $views
     *
     * @return Doctors
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer
     */
    public function getViews()
    {
        return $this->views;
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
     * Add hopital
     *
     * @param \DataBundle\Entity\Hopitaux $hopital
     *
     * @return Doctors
     */
    public function addHopital(\DataBundle\Entity\Hopitaux $hopital)
    {
        $this->hopital[] = $hopital;

        return $this;
    }

    /**
     * Remove hopital
     *
     * @param \DataBundle\Entity\Hopitaux $hopital
     */
    public function removeHopital(\DataBundle\Entity\Hopitaux $hopital)
    {
        $this->hopital->removeElement($hopital);
    }

    /**
     * Get hopital
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHopital()
    {
        return $this->hopital;
    }

    /**
     * Add specialitie
     *
     * @param \DataBundle\Entity\Specialities $specialitie
     *
     * @return Doctors
     */
    public function addSpecialitie(\DataBundle\Entity\Specialities $specialitie)
    {
        $this->specialitie[] = $specialitie;

        return $this;
    }

    /**
     * Remove specialitie
     *
     * @param \DataBundle\Entity\Specialities $specialitie
     */
    public function removeSpecialitie(\DataBundle\Entity\Specialities $specialitie)
    {
        $this->specialitie->removeElement($specialitie);
    }

    /**
     * Get specialitie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialitie()
    {
        return $this->specialitie;
    }
}

