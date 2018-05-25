<?php

namespace MyApp\FreelancerBundle\Controller;

use MyApp\FreelancerBundle\Entity\Skills;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

        return $this->render('@Freelancer/skills/index.html.twig', array(
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

        return $this->render('@Freelancer/skills/showDetail.html.twig', array(
            'skills' => $skills,
        ));
    }
        /**
         * Lists skill for Project displayed as progress bar.
         *
         */
        public function skillbarProjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('MyAppJobOwnerBundle:Project')->find($id);
        $skills = $em->getRepository('FreelancerBundle:Skills')->findBy(array("project"=>$project));


        return $this->render('@Freelancer/skills/showDetail.html.twig', array(
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

        return $this->render('@Freelancer/skills/new.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new skill for project.
     *
     */
    public function newSkillsProjectAction(Request $request,$id)
    {
        $skill = new Skills();
        $form = $this->createForm('MyApp\FreelancerBundle\Form\SkillsType', $skill);
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('MyAppJobOwnerBundle:Project')->find($id);
        $form->handleRequest($request);
        $user = $this->getUser();
        $skill->setUser($user);
        $skill->setProject($project);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skills_show', array('id' => $skill->getId()));
        }

        return $this->render('@Freelancer/skills/new.html.twig', array(
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

        return $this->render('@Freelancer/skills/show.html.twig', array(
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

        return $this->render('@Freelancer/skills/edit.html.twig', array(
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

    public function pdfAction()
    {
        $snappy = $this->get("knp_snappy.pdf");
        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository('FreelancerBundle:Skills')->findAll();

        $html = $this->renderView('FreelancerBundle:skills:pdf_skills.html.twig',array('skills' => $skills));
        $filename = "custom_pdf_from_twig";

        return new Response(
            $snappy->getOutputFromHtml($html),
            //ok status code
            200,
            array(

                'Content-Type'=>'application/pdf',
                'Content-Disposition'=> 'inline;filename="'.$filename.'.pdf'
                //'Content-Disposition'=> 'attachment;filename="'.$filename.'.pdf'
            )

        );

        //return new PdfResponse($this->get('knp_snappy.pdf')->getOutputFromHtml($html),'file.pdf');
        //$snappy = new Pdf('C://"Program Files"/wkhtmltopdf/bin/wkhtmltopdf.exe');

        // return new PdfResponse($snappy->generateFromHtml($html,'file.pdf'));
    }




}
