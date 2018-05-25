<?php

namespace MyApp\JobOwnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Tests
 *
 * @ORM\Table(name="tests")
 * @ORM\Entity(repositoryClass="MyApp\JobOwnerBundle\Repository\TestsRepository")
 */
class Tests
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
     * @var \DateTime
     *
     * @ORM\Column(name="testdate", type="date")
     */
    private $testdate;

    /**
     * @var string
     *
     * @ORM\Column(name="testdescription", type="string", length=255)
     */
    private $testdescription;

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255)
     */
    private $duration;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="freelancer",referencedColumnName="id",onDelete="CASCADE")
     */
    private $freelancer;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MyApp\JobOwnerBundle\Entity\Examen",inversedBy="id")
     * @ORM\JoinColumn(name="examen",referencedColumnName="id",onDelete="CASCADE")
     */
    private $examen;

    /**
     * @return mixed
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * @param mixed $freelancer
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;
    }


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
     * Set testdate
     *
     * @param \DateTime $testdate
     *
     * @return Tests
     */
    public function setTestdate($testdate)
    {
        $this->testdate = $testdate;

        return $this;
    }

    /**
     * Get testdate
     *
     * @return \DateTime
     */
    public function getTestdate()
    {
        return $this->testdate;
    }

    /**
     * Set testdescription
     *
     * @param string $testdescription
     *
     * @return Tests
     */
    public function setTestdescription($testdescription)
    {
        $this->testdescription = $testdescription;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * @param mixed $examen
     */
    public function setExamen($examen)
    {
        $this->examen = $examen;
    }

    /**
     * Get testdescription
     *
     * @return string
     */
    public function getTestdescription()
    {
        return $this->testdescription;
    }
}

