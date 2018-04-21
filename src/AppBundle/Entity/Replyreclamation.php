<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Replyreclamation
 *
 * @ORM\Table(name="replyreclamation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReplyreclamationRepository")
 */
class Replyreclamation
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
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var int
     *
     * @ORM\Column(name="idreclamation", type="integer")
     */
    private $idreclamation;


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
     * @return Replyreclamation
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
     * Set message
     *
     * @param string $message
     *
     * @return Replyreclamation
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set idreclamation
     *
     * @param integer $idreclamation
     *
     * @return Replyreclamation
     */
    public function setIdreclamation($idreclamation)
    {
        $this->idreclamation = $idreclamation;
    
        return $this;
    }

    /**
     * Get idreclamation
     *
     * @return integer
     */
    public function getIdreclamation()
    {
        return $this->idreclamation;
    }
}

