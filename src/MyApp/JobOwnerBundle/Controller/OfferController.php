<?php

namespace MyApp\JobOwnerBundle\Controller;

use MyApp\JobOwnerBundle\Entity\Offer;
use MyApp\FreelancerBundle\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Offer controller.
 *
 */
class OfferController extends Controller
{
    /**
     * Lists all offer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('MyAppJobOwnerBundle:Offer')->findAll();

        return $this->render('@MyAppJobOwner/offer/index.html.twig', array(
            'offers' => $offers,
        ));
    }
    /**
     * Lists all offer by Jobowner.
     *
     */
    public function offerByJbOwnerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $jobonwer= $this->getUser();
        $offer = $em->getRepository('MyAppJobOwnerBundle:Offer')->findBy(array("jobowner"=>$jobonwer));

        return $this->render('@MyAppJobOwner/Default/offerByJobOnwer.html.twig', array(
            'offers' => $offer,
        ));
    }

    /**
     * Lists all offer by Freelancer.
     *
     */
    public function offerByFreelancerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $freelancer= $this->getUser();
        $offer = $em->getRepository('MyAppJobOwnerBundle:Offer')->findBy(array("freelancer"=>$freelancer));
        $paginator  = $this->get('knp_paginator');

        $result= $paginator->paginate(
            $offer,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)
        );

        return $this->render('@Freelancer/Default/offerByFreelancer.html.twig', array(
            'offers' => $result,
        ));
    }

    /**
     * Creates a new offer entity.
     *
     */
    public function newAction(Request $request, $id)
    {

        $offer = new Offer();
        $form = $this->createForm('MyApp\JobOwnerBundle\Form\OfferType', $offer);
        $em = $this->getDoctrine()->getManager();
        $freelancer = $em->getRepository('FreelancerBundle:User')->find($id);
        $form->handleRequest($request);
        $jobowner=$this->getUser();
        $offer->setFreelancer($freelancer);
        $offer->setJobowner($jobowner);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('offer_show', array('id' => $offer->getId()));
        }

        return $this->render('@MyAppJobOwner/offer/new.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }




    /**
     * Finds and displays a offer entity.
     *
     */
    public function showAction(Offer $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);

        return $this->render('@MyAppJobOwner/offer/show.html.twig', array(
            'offer' => $offer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing offer entity.
     *
     */
    public function editAction(Request $request, Offer $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);
        $editForm = $this->createForm('MyApp\JobOwnerBundle\Form\OfferType', $offer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offer_edit', array('id' => $offer->getId()));
        }

        return $this->render('@MyAppJobOwner/offer/edit.html.twig', array(
            'offer' => $offer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a offer entity.
     *
     */
    public function deleteAction(Request $request, Offer $offer)
    {
        $form = $this->createDeleteForm($offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offer);
            $em->flush();
        }

        return $this->redirectToRoute('offer_index');
    }

    /**
     * Creates a form to delete a offer entity.
     *
     * @param Offer $offer The offer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Offer $offer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_delete', array('id' => $offer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
