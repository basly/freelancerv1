<?php
/**
 * Created by PhpStorm.
 * User: Raouf
 * Date: 4/28/2018
 * Time: 2:12 PM
 */

namespace NotifBundle\Entity;



use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle;
use Mgilet\NotificationBundle\Entity\NotifiableNotification as BaseNotifiableNotification;

/**
 * Class NotifiableNotification
 * @package Mgilet\NotificationBundle\Entity
 *
 * @ORM\Table(name="notifiable_notification")
 * @ORM\Entity(repositoryClass="Mgilet\NotificationBundle\Entity\Repository\NotifiableNotificationRepository")
 *
 */
class NotifiableNotification extends BaseNotifiableNotification
{

}
