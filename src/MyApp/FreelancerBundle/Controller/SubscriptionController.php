<?php

namespace MyApp\FreelancerBundle\Controller;

use MyApp\FreelancerBundle\Entity\Subscription;
use MyApp\FreelancerBundle\Entity\Training;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use MyApp\FreelancerBundle\Entity\User;

/**
 * Subscription controller.
 *
 * @Route("subscription")
 */
class SubscriptionController extends Controller
{

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
     * Lists all subscription entities.
     *
     * @Route("/mysubscribers", name="subscription_index")
     * @Method("GET")
     */
    public function indexsubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $subscriptions = $em->getRepository('FreelancerBundle:Subscription')->findBy(array('trainer'=>$id));
        return $this->render('FreelancerBundle:subscription:mysubscriptions.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }
    /**
     * Creates a new Reservation entity.
     *
     * @Route("/new/{idtraining}", name="subscription_new")
     * @Method({"GET", "POST"})
     */
    public function newsubscriptionAction(Request $request, $idtraining)
    {
        $subscription = new Subscription();
        $training = $this->getDoctrine()->getManager()->getRepository(Training::class)->find($idtraining);
        $subscription->setIdtraining($training);
        $subscription->setEmail($this->getUser()->getEmail());
        $subscription->setPrenom($this->getUser()->getFirstName());
        $subscription->setNom($this->getUser()->getLastName());
        $subscription->setTrainer($training->getTrainer());
            $em = $this->getDoctrine()->getManager();
            $em->persist($subscription);
            $em->flush();
        return $this->redirectToRoute('training_index');
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
}
