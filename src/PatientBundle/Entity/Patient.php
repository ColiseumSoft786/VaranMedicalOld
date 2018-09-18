<?php

namespace PatientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="PatientBundle\Repository\PatientRepository")
 * @Vich\Uploadable
 */
class Patient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="GSM", type="string", length=255)
     */
    private $gSM;

    /**
     * @var string
     *
     * @ORM\Column(name="domicile", type="string", length=255, nullable=true)
     */
    private $domicile;

    /**
     * @var string
     *
     * @ORM\Column(name="travail", type="string", length=255, nullable=true)
     */
    private $travail;

    /**
     * @var string
     *
     * @ORM\Column(name="preferredNumber", type="string", length=255)
     */
    private $preferredNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\OneToOne(targetEntity="MediasBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $profilPicture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="patient_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Patient
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
     * @return Patient
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
     * @return Patient
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
     * Set gSM
     *
     * @param string $gSM
     *
     * @return Patient
     */
    public function setGSM($gSM)
    {
        $this->gSM = $gSM;

        return $this;
    }

    /**
     * Get gSM
     *
     * @return string
     */
    public function getGSM()
    {
        return $this->gSM;
    }

    /**
     * Set domicile
     *
     * @param string $domicile
     *
     * @return Patient
     */
    public function setDomicile($domicile)
    {
        $this->domicile = $domicile;

        return $this;
    }

    /**
     * Get domicile
     *
     * @return string
     */
    public function getDomicile()
    {
        return $this->domicile;
    }

    /**
     * Set travail
     *
     * @param string $travail
     *
     * @return Patient
     */
    public function setTravail($travail)
    {
        $this->travail = $travail;

        return $this;
    }

    /**
     * Get travail
     *
     * @return string
     */
    public function getTravail()
    {
        return $this->travail;
    }

    /**
     * Set preferredNumber
     *
     * @param string $preferredNumber
     *
     * @return Patient
     */
    public function setPreferredNumber($preferredNumber)
    {
        $this->preferredNumber = $preferredNumber;

        return $this;
    }

    /**
     * Get preferredNumber
     *
     * @return string
     */
    public function getPreferredNumber()
    {
        return $this->preferredNumber;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Patient
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Patient
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set profilPicture
     *
     * @param \MediasBundle\Entity\Media $profilPicture
     *
     * @return Patient
     */
    public function setProfilPicture(\MediasBundle\Entity\Media $profilPicture = null)
    {
        $this->profilPicture = $profilPicture;

        return $this;
    }

    /**
     * Get profilPicture
     *
     * @return \MediasBundle\Entity\Media
     */
    public function getProfilPicture()
    {
        return $this->profilPicture;
    }
    
    
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

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
}
