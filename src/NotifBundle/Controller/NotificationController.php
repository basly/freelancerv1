<?php

namespace NotifBundle\Controller;

use Mgilet\NotificationBundle\Annotation\Notifiable;
use NotifBundle\Entity\NotifiableEntity;
use NotifBundle\Entity\NotifiableNotification;
use Symfony\Component\HttpFoundation\Request;
use Mgilet\NotificationBundle\Entity\Notification;
use Mgilet\NotificationBundle\NotifiableInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use MyApp\FreelancerBundle\Entity\Subscription;
use MyApp\FreelancerBundle\Entity\Training;
use MyApp\FreelancerBundle\Entity\User;
use MyApp\FreelancerBundle\FreelancerBundle;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Cache\Adapter\PdoAdapter;


use Mgilet\NotificationBundle\Controller\NotificationController as Base;


/**
 * Class NotificationController
 * the base controller for notifications
 */
class NotificationController extends Controller
{




    /**
     * List of all notifications
     *
     * @Route("/{notifiable}", name="notification_list")
     * @Method("GET")
     * @param NotifiableInterface $notifiable
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($notifiable)
    {
        $notifiableRepo = $this->get('doctrine.orm.entity_manager')->getRepository('MgiletNotificationBundle:NotifiableNotification');
        return $this->render('MgiletNotificationBundle::notifications.html.twig', array(
            'notifiableNotifications' => $notifiableRepo->findAllForNotifiableId($notifiable)
        ));
    }

    /**
     * Set a Notification as seen
     *
     * @Route("/{notifiable}/mark_as_seen/{notification}", name="notification_mark_as_seen")
     * @Method("POST")
     * @param int           $notifiable
     * @param Notification  $notification
     *
     * @return JsonResponse
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \LogicException
     */
    public function markAsSeenAction($notifiable, $notification)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAsSeen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            $manager->getNotification($notification),
            true
        );

        return new JsonResponse(true);
    }

    /**
     * Set a Notification as unseen
     *
     * @Route("/{notifiable}/mark_as_unseen/{notification}", name="notification_mark_as_unseen")
     * @Method("POST")
     * @param $notifiable
     * @param $notification
     *
     * @return JsonResponse
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \LogicException
     */
    public function markAsUnSeenAction($notifiable, $notification)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAsUnseen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            $manager->getNotification($notification),
            true
        );

        return new JsonResponse(true);
    }

    /**
     * Set all Notifications for a User as seen
     *
     * @Route("/{notifiable}/markAllSeen", name="mark_all_seen")
     * @Method("POST")
     * @param $notifiable
     *
     * @return JsonResponse
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function markAllSeenAction(Request $request, $notifiable)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAllAsSeen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            true
        );

        //var_dump($request->getBaseUrl());
        //var_dump($request->headers->get('referer'));
        //die;
        return $this->redirect($request->headers->get('referer'));
    }



    /**
     * Set all Notifications for a User as seen
     *
     * @Route("/markAllSeen", name="notification_mark_all_seen")
     *
     */
    public function markSeenAction(Request $request){
        /*

        $sql = '
        UPDATE notifiable_notification JOIN notifiable ON notifiable_notification.notifiable_entity_id = notifiable.id SET seen =1 WHERE seen = 0 AND identifier = id
        ';
        $stmt = $em->prepare($sql);
        $stmt->execute(['id' => $this->getUser()->getId()]);*/
        $em = $this->getDoctrine()->getManager();

        $id = $this->getUser()->getId();
        $notifiable = $em->getRepository('MgiletNotificationBundle:NotifiableEntity')->findBy(array('identifier'=>$id));



        $query = $em->createQuery('UPDATE NotifBundle:NotifiableNotification n set n.seen = 1 where n.seen = 0 and n.notifiableEntity = ?1 ');
        $query->setParameter(1, $notifiable[0]->getId());
        $reslt = $query->getResult();

        return $this->redirect($request->headers->get('referer'));

    }
}
