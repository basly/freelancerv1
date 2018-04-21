<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReclamationRepository")
 */
class Reclamation
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
     * @ORM\Column(name="Titre", type="string", length=255, unique=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="text", nullable=true)
     */
    private $sujet;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="statue", type="string", length=255)
     */
    private $statue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Creationdate", type="datetime")
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Finishdate", type="datetime", nullable=true)
     */
    private $finishdate;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Reclamation
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return Reclamation
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    
        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Reclamation
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
     * Set type
     *
     * @param string $type
     *
     * @return Reclamation
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set statue
     *
     * @param string $statue
     *
     * @return Reclamation
     */
    public function setStatue($statue)
    {
        $this->statue = $statue;
    
        return $this;
    }

    /**
     * Get statue
     *
     * @return string
     */
    public function getStatue()
    {
        return $this->statue;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return Reclamation
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;
    
        return $this;
    }

    /**
     * Get creationdate
     *
     * @return \DateTime
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * Set finishdate
     *
     * @param \DateTime $finishdate
     *
     * @return Reclamation
     */
    public function setFinishdate($finishdate)
    {
        $this->finishdate = $finishdate;
    
        return $this;
    }

    /**
     * Get finishdate
     *
     * @return \DateTime
     */
    public function getFinishdate()
    {
        return $this->finishdate;
    }
}

