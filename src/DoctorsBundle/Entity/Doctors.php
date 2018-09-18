<?php

namespace DoctorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Doctors
 *
 * @ORM\Table(name="doctors")
 * @ORM\Entity(repositoryClass="DoctorsBundle\Repository\DoctorsRepository")
 * @Vich\Uploadable
 */
class Doctors
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
     * @ORM\Column(name="first_name", type="string", nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="birthday", type="date", nullable=false)
     */

    private $birthday;



    /**
     * @var string
     *
     * @ORM\Column(name="GSM", type="string", nullable=true)
     */
    private $GSM;
    /**
     * @var integer
     *
     * @ORM\Column(name="Views", type="integer", nullable=true)
     */
    private $views;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="professional_statement", type="text" , nullable=true)
     */
    private $professionalStatement;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="doctors_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;
    

    /**
     * @ORM\OneToOne(targetEntity="AppointmentsBundle\Entity\Settings", mappedBy="doctor")
     */
    private $settings;

    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Educations", mappedBy="doctor")
     */
    private $education;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\hopitaux", mappedBy="doctors")
     */
    private $hopitaux;

    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Certifications", mappedBy="doctor")
     */
    private $certifications;

    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Invoices", mappedBy="doctor")
     */
    private $invoices;
    
    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Locations", mappedBy="doctor")
     */
    private $location;

    /**
     * @ORM\ManyToMany(targetEntity="DoctorsBundle\Entity\Specialities", mappedBy="doctors")
     */
    private $specialities;

    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Reviews", mappedBy="doctor")
     */
    private $review;
    
    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Questions", mappedBy="doctor")
     */
    private $question;
    
    /**
     * @ORM\OneToMany(targetEntity="DoctorsBundle\Entity\Comments", mappedBy="doctor")
     */
    private $comment;
    
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Doctors
     */
    public function setViews($view)
    {
        $this->views = $view;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getViews()
    {
        return $this->views;
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
     * Set gSM
     *
     * @param string $gSM
     *
     * @return Doctors
     */
    public function setGSM($gSM)
    {
        $this->GSM = $gSM;

        return $this;
    }

    /**
     * Get gSM
     *
     * @return string
     */
    public function getGSM()
    {
        return $this->GSM;
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
     * Constructor
     */
    public function __construct()
    {
        $this->education = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hopitaux = new \Doctrine\Common\Collections\ArrayCollection();
        $this->certifications = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add education
     *
     * @param \DoctorsBundle\Entity\Educations $education
     *
     * @return Doctors
     */
    public function addEducation(\DoctorsBundle\Entity\Educations $education)
    {
        $this->education[] = $education;

        return $this;
    }


    /**
     * Remove education
     *
     * @param \DoctorsBundle\Entity\Educations $education
     */
    public function removeEducation(\DoctorsBundle\Entity\Educations $education)
    {
        $this->education->removeElement($education);
    }

    /**
     * Get education
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Add hopitaux
     *
     * @param \AppBundle\Entity\Hopitaux $hopitaux
     *
     * @return Doctors
     */
    public function addHopitaux(\AppBundle\Entity\Hopitaux $hopitaux)
    {
        $this->hopitaux[] = $hopitaux;

        return $this;
    }

    /**
     * Remove hopitaux
     *
     * @param \AppBundle\Entity\Hopitaux $hopitaux
     */
    public function removeHopitaux(\AppBundle\Entity\Hopitaux $hopitaux)
    {
        $this->hopitaux->removeElement($hopitaux);
    }

    /**
     * Get hopitaux
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHopitaux()
    {
        return $this->hopitaux;
    }

    /**
     * Add certification
     *
     * @param \DoctorsBundle\Entity\Certifications $certification
     *
     * @return Doctors
     */
    public function addCertification(\DoctorsBundle\Entity\Certifications $certification)
    {
        $this->certifications[] = $certification;

        return $this;
    }

    /**
     * Remove certification
     *
     * @param \DoctorsBundle\Entity\Certifications $certification
     */
    public function removeCertification(\DoctorsBundle\Entity\Certifications $certification)
    {
        $this->certifications->removeElement($certification);
    }

    /**
     * Get certifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * Add speciality
     *
     * @param \DoctorsBundle\Entity\Specialities $speciality
     *
     * @return Doctors
     */
    public function addSpeciality(\DoctorsBundle\Entity\Specialities $speciality)
    {
        $this->specialities[] = $speciality;

        return $this;
    }

    /**
     * Remove speciality
     *
     * @param \DoctorsBundle\Entity\Specialities $speciality
     */
    public function removeSpeciality(\DoctorsBundle\Entity\Specialities $speciality)
    {
        $this->specialities->removeElement($speciality);
    }

    /**
     * Get specialities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialities()
    {
        return $this->specialities;
    }

    function __toString()
    {
        return $this->firstName.' '.$this->lastName;
    }



    /**
     * Add location
     *
     * @param \DoctorsBundle\Entity\Locations $location
     *
     * @return Doctors
     */
    public function addLocation(\DoctorsBundle\Entity\Locations $location)
    {
        $this->location[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \DoctorsBundle\Entity\Locations $location
     */
    public function removeLocation(\DoctorsBundle\Entity\Locations $location)
    {
        $this->location->removeElement($location);
    }

    /**
     * Get location
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocation()
    {
        return $this->location;
    }


    /**
     * Add invoice
     *
     * @param \DoctorsBundle\Entity\Invoices $invoice
     *
     * @return Doctors
     */
    public function addInvoice(\DoctorsBundle\Entity\Invoices $invoice)
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * Remove invoice
     *
     * @param \DoctorsBundle\Entity\Invoices $invoice
     */
    public function removeInvoice(\DoctorsBundle\Entity\Invoices $invoice)
    {
        $this->invoices->removeElement($invoice);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    /**
     * Add setting
     *
     * @param \AppointmentsBundle\Entity\Settings $setting
     *
     * @return Doctors
     */
    public function addSetting(\AppointmentsBundle\Entity\Settings $setting)
    {
        $this->settings[] = $setting;

        return $this;
    }

    /**
     * Remove setting
     *
     * @param \AppointmentsBundle\Entity\Settings $setting
     */
    public function removeSetting(\AppointmentsBundle\Entity\Settings $setting)
    {
        $this->settings->removeElement($setting);
    }

    /**
     * Get settings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set settings
     *
     * @param \AppointmentsBundle\Entity\Settings $settings
     *
     * @return Doctors
     */
    public function setSettings(\AppointmentsBundle\Entity\Settings $settings = null)
    {
        $this->settings = $settings;

        return $this;
    }
    
    /**
     * Add review
     *
     * @param \DoctorsBundle\Entity\Reviews $review
     *
     * @return Doctors
     */
    public function addReview(\DoctorsBundle\Entity\Reviews $review)
    {
        $this->review[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \DoctorsBundle\Entity\Reviews $review
     */
    public function removeReview(\DoctorsBundle\Entity\Reviews $review)
    {
        $this->review->removeElement($review);
    }

    /**
     * Get review
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReview()
    {
        return $this->review;
    }
    
    /**
     * Add question
     *
     * @param \DoctorsBundle\Entity\Questions $question
     *
     * @return Doctors
     */
    public function addQuestion(\DoctorsBundle\Entity\Questions $question)
    {
        $this->question[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \DoctorsBundle\Entity\Questions $question
     */
    public function removeQuestion(\DoctorsBundle\Entity\Questions $question)
    {
        $this->question->removeElement($question);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * Add comment
     *
     * @param \DoctorsBundle\Entity\Questions $comment
     *
     * @return Doctors
     */
    public function addComment(\DoctorsBundle\Entity\Comments $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \DoctorsBundle\Entity\Comments $comment
     */
    public function removeComment(\DoctorsBundle\Entity\Comments $omment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get question
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestion()
    {
        return $this->question;
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
