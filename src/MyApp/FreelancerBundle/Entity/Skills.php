<?php

namespace MyApp\FreelancerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 *
 * @ORM\Table(name="skills")
 * @ORM\Entity(repositoryClass="MyApp\FreelancerBundle\Repository\SkillsRepository")
 */
class Skills
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
     * @ORM\Column(name="skillname", type="string", length=255)
     */
    private $skillname;

    /**
     * @var int
     *
     * @ORM\Column(name="skillexperience", type="integer")
     */
    private $skillexperience;

    /**
     * @var string
     *
     * @ORM\Column(name="certification", type="string", length=255)
     */
    private $certification;

    /**
     * @var string
     *
     * @ORM\Column(name="skilllevel", type="string", length=255)
     */
    private $skilllevel;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MyApp\FreelancerBundle\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="user",referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
     * Set skillname
     *
     * @param string $skillname
     *
     * @return Skills
     */
    public function setSkillname($skillname)
    {
        $this->skillname = $skillname;

        return $this;
    }

    /**
     * Get skillname
     *
     * @return string
     */
    public function getSkillname()
    {
        return $this->skillname;
    }

    /**
     * Set skillexperience
     *
     * @param integer $skillexperience
     *
     * @return Skills
     */
    public function setSkillexperience($skillexperience)
    {
        $this->skillexperience = $skillexperience;

        return $this;
    }

    /**
     * Get skillexperience
     *
     * @return int
     */
    public function getSkillexperience()
    {
        return $this->skillexperience;
    }

    /**
     * Set certification
     *
     * @param string $certification
     *
     * @return Skills
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification
     *
     * @return string
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set skilllevel
     *
     * @param string $skilllevel
     *
     * @return Skills
     */
    public function setSkilllevel($skilllevel)
    {
        $this->skilllevel = $skilllevel;

        return $this;
    }

    /**
     * Get skilllevel
     *
     * @return string
     */
    public function getSkilllevel()
    {
        return $this->skilllevel;
    }
}

