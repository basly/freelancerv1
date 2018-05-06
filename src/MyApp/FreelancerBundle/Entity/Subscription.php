<?php

namespace MyApp\FreelancerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\NotifiableInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription")
 * @ORM\Entity(repositoryClass="MyApp\FreelancerBundle\Repository\SubscriptionRepository")
 */
class Subscription  implements NotifiableInterface
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
     *  @var \MyApp\FreelancerBundle\Entity\Training
     *
     *  @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\Training")
     *  @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="Idtraining", referencedColumnName="id")
     * })
     */
    private $idtraining;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=25, nullable=true)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25, nullable=false)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=25, nullable=true)
     */
    private $prenom;

    /**
     * Subscription constructor.
     *
     */
    /**
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\User")
     * @ORM\JoinColumn(name="trainer")
     */

    private $trainer;

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

    public function __construct()
    {

    }

    /**
     * Set id
     *
     * @param \MyApp\FreelancerBundle\Entity\Training $id
     *
     * @return Subscription
     */
    public function setId(\MyApp\FreelancerBundle\Entity\Training $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return Training
     */
    public function getIdtraining()
    {
        return $this->idtraining;
    }

    /**
     * @param Training $idtraining
     */
    public function setIdtraining($idtraining)
    {
        $this->idtraining = $idtraining;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }


}

