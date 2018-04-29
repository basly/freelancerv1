<?php

namespace MyApp\FreelancerBundle\Controller;

use MyApp\FreelancerBundle\Entity\Demande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Demande controller.
 *
 */
class DemandeController extends Controller
{

    /**
     * Lists all demande by JobOwner.
     *
     */
    public function demandByJobOwnerAction()
    {
        $allDemandes = array();
        foreach ($this->getUser()->projects as $p) {
            //echo $p->getProjectname()."<br>";
            foreach ($p->demandes as $demande) {
                //echo "<b>".$demande->getDescription().'</b><br>';
                $allDemandes[]=$demande;
            }
        }
        //var_dump($allDemandes);
        // die;
        $em = $this->getDoctrine()->getManager();

        return $this->render('@MyAppJobOwner/Default/demandByJobowner.html.twig', array(
            'demandes' => $allDemandes,
        ));
    }

    /**
     * Lists all demande by Freelancer.
     *
     */
    public function demandByFreelancerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $freelancer= $this->getUser();
        $demandes = $em->getRepository('FreelancerBundle:Demande')->findBy(array("freelancer"=>$freelancer));

        $paginator  = $this->get('knp_paginator');

        $result= $paginator->paginate(
            $demandes,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)

        );


        return $this->render('@Freelancer/demande/demandeByFreelancer.html.twig', array(
            'demandes' => $result,
        ));
    }

    /**
     * Creates a new demande entity.
     *
     */
    public function newAction(Request $request)
    {
        $demande = new Demande();
        $form = $this->createForm('MyApp\FreelancerBundle\Form\DemandeType', $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


                $em = $this->getDoctrine()->getManager();
                $em->persist($demande);
                $em->flush();

            return $this->redirectToRoute('demande_show', array('id' => $demande->getId()));
        }

        return $this->render('@Freelancer/demande/new.html.twig', array(
            'demande' => $demande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demande entity.
     *
     */
    public function showAction(Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);

        return $this->render('@Freelancer/demande/show.html.twig', array(
            'demande' => $demande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demande entity.
     *
     */
    public function editAction(Request $request, Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);
        $editForm = $this->createForm('MyApp\FreelancerBundle\Form\EditDemandeType', $demande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_edit', array('id' => $demande->getId()));
        }

        return $this->render('@Freelancer/demande/edit.html.twig', array(
            'demande' => $demande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demande entity.
     *
     */
    public function deleteAction(Request $request, Demande $demande)
    {
        $form = $this->createDeleteForm($demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demande);
            $em->flush();
        }

        return $this->redirectToRoute('demande_index');
    }

    /**
     * Creates a form to delete a demande entity.
     *
     * @param Demande $demande The demande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demande $demande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demande_delete', array('id' => $demande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function addAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $freelancer = $em->getRepository('MyAppJobOwnerBundle:Project')->find($id);
        $demand = new Demande();
        $form = $this->createForm('MyApp\FreelancerBundle\Form\DemandeType', $demand);
        $form->handleRequest($request);
        $demand->setProject($freelancer);

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        /*$jobs = $em->getRepository('FreelancerBundle:User')->findAll();
        foreach ($jobs as $j){
            $job = $j;
        }*/
        $demand->setFreelancer($user);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demand);
            $em->flush();

            return $this->redirectToRoute('demande_show', array('id' => $demand->getId()));
        }

        return $this->render('@Freelancer/demande/new.html.twig', array(
            'demand' => $demand,
            'form' => $form->createView(),
        ));
    }





}
