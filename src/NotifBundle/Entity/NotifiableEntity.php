<?php



namespace NotifBundle\Entity;



use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Mgilet\NotificationBundle\Entity\NotifiableEntity as BaseNotifiableEntity;

/**
 * Class NotifiableEntity
 * @package Mgilet\NotificationBundle\Entity
 *
 * @ORM\Table(name="notifiable")
 * @ORM\Entity(repositoryClass="Mgilet\NotificationBundle\Entity\Repository\NotifiableRepository")
 * @UniqueEntity(fields={"identifier", "class"})
 */
class NotifiableEntity extends BaseNotifiableEntity
{

}
