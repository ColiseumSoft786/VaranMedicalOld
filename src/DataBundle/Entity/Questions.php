<?php

namespace DataBundle\Entity;

/**
 * Questions
 */
class Questions
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $question;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DataBundle\Entity\Doctors
     */
    private $doctor;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Questions
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
     * Set question
     *
     * @param string $question
     *
     * @return Questions
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
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
     * Set doctor
     *
     * @param \DataBundle\Entity\Doctors $doctor
     *
     * @return Questions
     */
    public function setDoctor(\DataBundle\Entity\Doctors $doctor = null)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get doctor
     *
     * @return \DataBundle\Entity\Doctors
     */
    public function getDoctor()
    {
        return $this->doctor;
    }
}
