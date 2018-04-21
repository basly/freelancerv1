<?php

namespace MyApp\FreelancerBundle\Controller;

use MyApp\FreelancerBundle\Entity\Skills;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Skill controller.
 *
 */
class SkillsController extends Controller
{
    /**
     * Lists all skill entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository('FreelancerBundle:Skills')->findAll();

        return $this->render('skills/index.html.twig', array(
            'skills' => $skills,
        ));
    }

    /**
     * Lists all skill displayed as progress bar.
     *
     */
    public function skillbarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository('FreelancerBundle:Skills')->findAll();

        return $this->render('skills/showDetail.html.twig', array(
            'skills' => $skills,
        ));
    }





    /**
     * Creates a new skill entity.
     *
     */
    public function newAction(Request $request)
    {
        $skill = new Skills();
        $form = $this->createForm('MyApp\FreelancerBundle\Form\SkillsType', $skill);
        $form->handleRequest($request);
        $user = $this->getUser();
        $skill->setUser($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skills_show', array('id' => $skill->getId()));
        }

        return $this->render('skills/new.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a skill entity.
     *
     */
    public function showAction(Skills $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);

        return $this->render('skills/show.html.twig', array(
            'skill' => $skill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing skill entity.
     *
     */
    public function editAction(Request $request, Skills $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);
        $editForm = $this->createForm('MyApp\FreelancerBundle\Form\SkillsType', $skill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skills_edit', array('id' => $skill->getId()));
        }

        return $this->render('skills/edit.html.twig', array(
            'skill' => $skill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a skill entity.
     *
     */
    public function deleteAction(Request $request, Skills $skill)
    {
        $form = $this->createDeleteForm($skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skill);
            $em->flush();
        }

        return $this->redirectToRoute('skills_index');
    }

    /**
     * Creates a form to delete a skill entity.
     *
     * @param Skills $skill The skill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Skills $skill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('skills_delete', array('id' => $skill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
