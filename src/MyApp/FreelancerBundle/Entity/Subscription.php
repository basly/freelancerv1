<?php

namespace MyApp\FreelancerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription")
 * @ORM\Entity(repositoryClass="MyApp\FreelancerBundle\Repository\SubscriptionRepository")
 */
class Subscription
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
     * @ORM\Column(name="idtraining", type="string", length=255)
     */
    private $idtraining;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\User")
     * @ORM\JoinColumn(name="idsubscriber",referencedColumnName="id")
     */

    private $idsubscriber;

    /**
     * Subscription constructor.
     *
     */
    public function __construct()
    {

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
     * Set idtraining
     *
     * @param string $idtraining
     *
     * @return Subscription
     */
    public function setIdtraining($idtraining)
    {
        $this->idtraining = $idtraining;

        return $this;
    }

    /**
     * Get idtraining
     *
     * @return string
     */
    public function getIdtraining()
    {
        return $this->idtraining;
    }

    /**
     * @return mixed
     */
    public function getIdsubscriber()
    {
        return $this->idsubscriber;
    }

    /**
     * @param mixed $idsubscriber
     */
    public function setIdsubscriber($idsubscriber)
    {
        $this->idsubscriber = $idsubscriber;
    }


}

