<?php

namespace MyApp\FreelancerBundle\Controller;

use Mgilet\NotificationBundle\Controller\NotificationController;
use Mgilet\NotificationBundle\Entity\Notification;
use MyApp\FreelancerBundle\Entity\Subscription;
use MyApp\FreelancerBundle\Entity\Training;
use MyApp\FreelancerBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Training controller.
 *
 * @Route("training")
 */
class TrainingController extends Controller
{
    /**
     * Lists all training entities.
     *
     * @Route("/", name="training_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trainings = $em->getRepository('FreelancerBundle:Training')->findAll();

        return $this->render('@Freelancer/training/index.html.twig', array(
            'trainings' => $trainings,
        ));
    }


    /**
     * Lists all training entities.
     *
     * @Route("/mytrainings", name="my_trainings")
     * @Method("GET")
     */
    public function mytrainingAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $trainings = $em->getRepository('FreelancerBundle:Training')->findBy(array('trainer'=>$id));
        return $this->render('@Freelancer/training/mytrainings.html.twig', array(
            'trainings' => $trainings,
        ));
    }


    /**
     * Creates a new training entity.
     *@throws \Doctrine\ORM\OptimisticLockException
     * @Route("/new", name="training_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $training = new Training();

        $user= $this->getUser();
        $form = $this->createForm('MyApp\FreelancerBundle\Form\TrainingType', $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           // $training->setTrainer($this->getUser()->getId());
            $training->setTrainer($user);
            $em->persist($training);
            $em->flush();

            $manager = $this->get('mgilet.notification');
            $notif = $manager->createNotification('New training was created');
          //  $notif->setMessage('This a notification.');
            $manager->addNotification([$user], $notif, true);

            return $this->redirectToRoute('training_show', array('id' => $training->getId()));

        }

        return $this->render('@Freelancer/training/new.html.twig', array(
            'training' => $training,
            'form' => $form->createView(),
        ));

    }

    /**
     * Finds and displays a training entity.
     *
     * @Route("/{id}", name="training_show")
     * @Method("GET")
     */
    public function showAction(Training $training)
    {
        $deleteForm = $this->createDeleteForm($training);

        return $this->render('@Freelancer/training/show.html.twig', array(
            'training' => $training,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing training entity.
     *
     * @Route("/{id}/edit", name="training_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Training $training)
    {
        $deleteForm = $this->createDeleteForm($training);
        $editForm = $this->createForm('MyApp\FreelancerBundle\Form\TrainingType', $training);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('training_edit', array('id' => $training->getId()));

        }

        return $this->render('@Freelancer/training/edit.html.twig', array(
            'training' => $training,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a training entity.
     *
     * @Route("/{id}", name="training_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Training $training)
    {
        $form = $this->createDeleteForm($training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($training);
            $em->flush();
        }

        return $this->redirectToRoute('training_index');
    }

    /**
     * Creates a form to delete a training entity.
     *
     * @param Training $training The training entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Training $training)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('training_delete', array('id' => $training->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function sendNotification(User $user)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('NotificationBundle subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        $manager->addNotification([$user], $notif, true);

        return $this->redirectToRoute('homenotif');
    }

    /**
     * Set all Notifications for a User as seen
     *
     * @Route("/markAllSeen", name="mark_all_seen")
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
     * Creates a new training entity.
     * @Route("/subscribe/{training}", name="training_subscribe")
     * @Method({"GET", "POST"})
     */

    public function subscribeAction(Request $request, $training)
    {

        $subscription = new Subscription();
        $subscription->setIdsubscriber($this->getUser());
        $subscription->setIdtraining($training);

        $em = $this->getDoctrine()->getManager();
        $em->persist($subscription);

        $user= $this->getUser();

        $em->flush();
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('New training was created');
        //  $notif->setMessage('This a notification.');
        $manager->addNotification([$user], $notif, true);

        return $this->redirectToRoute('training_index');
    }



}



