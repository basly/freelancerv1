<?php

namespace MyApp\FreelancerBundle\Controller;

use MyApp\FreelancerBundle\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Subscription controller.
 *
 * @Route("subscription")
 */
class SubscriptionController extends Controller
{
    /**
     * Lists all subscription entities.
     *
     * @Route("/", name="subscription_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscriptions = $em->getRepository('FreelancerBundle:Subscription')->findAll();

        return $this->render('FreelancerBundle:subscription:index.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }

    /**
     * Creates a new subscription entity.
     *
     * @Route("/new", name="subscription_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $subscription = new Subscription();
        $form = $this->createForm('MyApp\FreelancerBundle\Form\SubscriptionType', $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subscription);
            $em->flush();

            return $this->redirectToRoute('subscription_show', array('id' => $subscription->getId()));
        }

        return $this->render('FreelancerBundle:subscription:new.html.twig', array(
            'subscription' => $subscription,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subscription entity.
     *
     * @Route("/{id}", name="subscription_show")
     * @Method("GET")
     */
    public function showAction(Subscription $subscription)
    {
        $deleteForm = $this->createDeleteForm($subscription);

        return $this->render('FreelancerBundle:subscription:show.html.twig', array(
            'subscription' => $subscription,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subscription entity.
     *
     * @Route("/{id}/edit", name="subscription_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Subscription $subscription)
    {
        $deleteForm = $this->createDeleteForm($subscription);
        $editForm = $this->createForm('MyApp\FreelancerBundle\Form\SubscriptionType', $subscription);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subscription_edit', array('id' => $subscription->getId()));
        }

        return $this->render('FreelancerBundle:subscription:edit.html.twig', array(
            'subscription' => $subscription,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subscription entity.
     *
     * @Route("/{id}", name="subscription_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Subscription $subscription)
    {
        $form = $this->createDeleteForm($subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subscription);
            $em->flush();
        }

        return $this->redirectToRoute('subscription_index');
    }

    /**
     * Creates a form to delete a subscription entity.
     *
     * @param Subscription $subscription The subscription entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subscription $subscription)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subscription_delete', array('id' => $subscription->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Lists all subscription entities.
     *
     * @Route("/mysubscriptions", name="mysubscriptions")
     *
     * @Method("GET")
     */
   public function mysubscriptionsAction(Subscription $subscription)
    {
      //  $em = $this->getDoctrine()->getManager();
      //  $subscription = new Subscription();
       // $subscription = $em->getRepository('FreelancerBundle:Subscription')->findAll();


      //  $userManager = $this->get('fos_user.user_manager');
       // $us = $this->getUser();
      // $user = $userManager->findUserByEmail($us->getEmail());
        $user = $this->getUser();
     //   $parameters = array('iduser' => $user->getId());
        $iduser = $user->getId();
/*
        $sql = 'SELECT trainingTitle,firstName,lastName  FROM `subscription` as s, `training` as t,user as u WHERE t.trainer =: iduser and t.id =s.idtraining and u.id = s.idsubscriber';
        $query1 = $this->getEntityManager()->createQuery($sql);

        $subscriptions = $query1->getResult();

        */

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('MyApp\FreelancerBundle\Entity\Training', 't');
        $rsm->addEntityResult('MyApp\FreelancerBundle\Entity\Subscription', 's');
        $rsm->addEntityResult('MyApp\FreelancerBundle\Entity\User', 'u');
        $rsm->addFieldResult('t', 'trainer', 'trainer');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('s', 'idtraining', 'idtraining');
        $rsm->addFieldResult('s', 'idsubscriber', 'idsubscriber');

        $sql = 'SELECT trainingTitle,firstName,lastName  FROM `subscription` as s, `training` as t,user as u WHERE t.trainer = :? and t.id =s.idtraining and u.id = s.idsubscriber';

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameters(1, $iduser);

        $subscriptions = $query->getResult();

        return $this->redirectToRoute('mysubscriptions', array(
            'mysubscribers' => $subscriptions,));
    }









}
