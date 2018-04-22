<?php

namespace MyApp\FreelancerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;


/**
 * Training
 *
 * @ORM\Table(name="training")
 * @ORM\Entity(repositoryClass="MyApp\FreelancerBundle\Repository\TrainingRepository")
 * @Notifiable(name="training")
 */
class Training  implements NotifiableInterface
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
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\User" ,inversedBy="training")
     * @ORM\JoinColumn(name="trainer")
     */


     private $trainer;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\Subscription" ,inversedBy="training")
     * @ORM\JoinColumn(name="idsubscription")
     */

    private $subscription;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingTitle", type="string", length=255)
     */
    private $trainingTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingPrice", type="string", length=255)
     */
    private $trainingPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="startDate", type="string")
     */
    private $startDate;

    /**
     * @var int
     *
     * @ORM\Column(name="seatNumber", type="integer")
     */
    private $seatNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingStatus", type="string", length=255)
     */
    private $trainingStatus;

    /**
     * @return mixed
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * @param mixed $trainer
     */
    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;
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
     * Set trainingTitle
     *
     * @param string $trainingTitle
     *
     * @return Training
     */
    public function setTrainingTitle($trainingTitle)
    {
        $this->trainingTitle = $trainingTitle;

        return $this;
    }

    /**
     * Get trainingTitle
     *
     * @return string
     */
    public function getTrainingTitle()
    {
        return $this->trainingTitle;
    }

    /**
     * Set trainingPrice
     *
     * @param string $trainingPrice
     *
     * @return Training
     */
    public function setTrainingPrice($trainingPrice)
    {
        $this->trainingPrice = $trainingPrice;

        return $this;
    }

    /**
     * Get trainingPrice
     *
     * @return string
     */
    public function getTrainingPrice()
    {
        return $this->trainingPrice;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Set seatNumber
     *
     * @param integer $seatNumber
     *
     * @return Training
     */
    public function setSeatNumber($seatNumber)
    {
        $this->seatNumber = $seatNumber;

        return $this;
    }

    /**
     * Get seatNumber
     *
     * @return int
     */
    public function getSeatNumber()
    {
        return $this->seatNumber;
    }

    /**
     * Set trainingStatus
     *
     * @param string $trainingStatus
     *
     * @return Training
     */
    public function setTrainingStatus($trainingStatus)
    {
        $this->trainingStatus = $trainingStatus;

        return $this;
    }

    /**
     * Get trainingStatus
     *
     * @return string
     */
    public function getTrainingStatus()
    {
        return $this->trainingStatus;
    }

    /**
     * @return mixed
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * @param mixed $subscription
     */
    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
    }

}

