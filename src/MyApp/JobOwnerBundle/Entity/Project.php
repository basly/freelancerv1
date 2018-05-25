<?php

namespace MyApp\JobOwnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="MyApp\JobOwnerBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="projectname", type="string", length=255)
     */
    private $projectname;

    /**
     * @var string
     *
     * @ORM\Column(name="activityarea", type="string", length=255)
     */
    private $activityarea;

    /**
     * @var string
     *
     * @ORM\Column(name="projectdescription", type="string", length=255)
     */
    private $projectdescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endtdate", type="date")
     */
    private $enddate;

    /**
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=255)
     */
    private $payment;

    /**
     * @var string
     *
     * @ORM\Column(name="experiencelevel", type="string", length=255)
     */
    private $experiencelevel;

    /**
     * @var string
     *
     * @ORM\Column(name="requiredskills", type="string", length=255)
     */
    private $requiredskills;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\User",inversedBy="projects")
     * @ORM\JoinColumn(name="jobowner",referencedColumnName="id",onDelete="CASCADE")
     */
    private $jobowner;


    /**
     * One Project has Many Demandes.
     * @ORM\OneToMany(targetEntity="MyApp\FreelancerBundle\Entity\Demande", mappedBy="project")
     */
    public $demandes;


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
     * Set projectname
     *
     * @param string $projectname
     *
     * @return Project
     */
    public function setProjectname($projectname)
    {
        $this->projectname = $projectname;

        return $this;
    }

    /**
     * Get projectname
     *
     * @return string
     */
    public function getProjectname()
    {
        return $this->projectname;
    }

    /**
     * Set activityarea
     *
     * @param string $activityarea
     *
     * @return Project
     */
    public function setActivityarea($activityarea)
    {
        $this->activityarea = $activityarea;

        return $this;
    }

    /**
     * Get activityarea
     *
     * @return string
     */
    public function getActivityarea()
    {
        return $this->activityarea;
    }

    /**
     * Set projectdescription
     *
     * @param string $projectdescription
     *
     * @return Project
     */
    public function setProjectdescription($projectdescription)
    {
        $this->projectdescription = $projectdescription;

        return $this;
    }

    /**
     * Get projectdescription
     *
     * @return string
     */
    public function getProjectdescription()
    {
        return $this->projectdescription;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Project
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * @param \DateTime $enddate
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }



    /**
     * Set payment
     *
     * @param string $payment
     *
     * @return Project
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return string
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set experiencelevel
     *
     * @param string $experiencelevel
     *
     * @return Project
     */
    public function setExperiencelevel($experiencelevel)
    {
        $this->experiencelevel = $experiencelevel;

        return $this;
    }

    /**
     * Get experiencelevel
     *
     * @return string
     */
    public function getExperiencelevel()
    {
        return $this->experiencelevel;
    }

    /**
     * Set requiredskills
     *
     * @param string $requiredskills
     *
     * @return Project
     */
    public function setRequiredskills($requiredskills)
    {
        $this->requiredskills = $requiredskills;

        return $this;
    }

    /**
     * Get requiredskills
     *
     * @return string
     */
    public function getRequiredskills()
    {
        return $this->requiredskills;
    }

    /**
     * @return mixed
     */
    public function getDemandes()
    {
        return $this->demandes;
    }

    /**
     * @param mixed $demandes
     */
    public function setDemandes($demandes)
    {
        $this->demandes = $demandes;
    }

    /**
     * @return mixed
     */
    public function getJobowner()
    {
        return $this->jobowner;
    }

    /**
     * @param mixed $jobowner
     */
    public function setJobowner($jobowner)
    {
        $this->jobowner = $jobowner;
    }



}

