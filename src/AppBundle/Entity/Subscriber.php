<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscriber
 *
 * @ORM\Table(name="subscriber")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubscriberRepository")
 */
class Subscriber
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
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer")
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="idsubscriber", type="integer")
     */
    private $idsubscriber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;


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
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Subscriber
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    
        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set idsubscriber
     *
     * @param integer $idsubscriber
     *
     * @return Subscriber
     */
    public function setIdsubscriber($idsubscriber)
    {
        $this->idsubscriber = $idsubscriber;
    
        return $this;
    }

    /**
     * Get idsubscriber
     *
     * @return integer
     */
    public function getIdsubscriber()
    {
        return $this->idsubscriber;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Subscriber
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

