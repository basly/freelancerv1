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
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\User")
     * @ORM\JoinColumn(name="trainer")
     */

    private $trainer;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * @param string $trainer
     */
    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;
    }


    /**
     * @return string
     */
    public function getTrainingTitle()
    {
        return $this->trainingTitle;
    }

    /**
     * @param string $trainingTitle
     */
    public function setTrainingTitle($trainingTitle)
    {
        $this->trainingTitle = $trainingTitle;
    }

    /**
     * @return string
     */
    public function getTrainingPrice()
    {
        return $this->trainingPrice;
    }

    /**
     * @param string $trainingPrice
     */
    public function setTrainingPrice($trainingPrice)
    {
        $this->trainingPrice = $trainingPrice;
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
     * @return int
     */
    public function getSeatNumber()
    {
        return $this->seatNumber;
    }

    /**
     * @param int $seatNumber
     */
    public function setSeatNumber($seatNumber)
    {
        $this->seatNumber = $seatNumber;
    }

    /**
     * @return string
     */
    public function getTrainingStatus()
    {
        return $this->trainingStatus;
    }

    /**
     * @param string $trainingStatus
     */
    public function setTrainingStatus($trainingStatus)
    {
        $this->trainingStatus = $trainingStatus;
    }

}