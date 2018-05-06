<?php

namespace MyApp\FreelancerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Skills
 *
 * @ORM\Table(name="skills")
 * @ORM\Entity(repositoryClass="MyApp\FreelancerBundle\Repository\SkillsRepository")
 * @Vich\Uploadable
 */
class Skills
{

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * @param int $imageSize
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;
    }

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;


    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }





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
     *
     * @ORM\ManyToOne(targetEntity="MyApp\JobOwnerBundle\Entity\Project",inversedBy="id")
     * @ORM\JoinColumn(name="project",referencedColumnName="id",onDelete="CASCADE")
     */
    private $project;

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

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }


}

