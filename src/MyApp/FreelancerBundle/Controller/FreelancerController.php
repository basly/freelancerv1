<?php

namespace MyApp\FreelancerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class FreelancerController extends Controller
{

    /**
     * home  freelancer .
     *
     * @Route("/home", name="freelancer_home")
     *
     */
    public function homeAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $ps = $em->getRepository('AppBundle:Projects')->findAll();
        $user = $this->getUser();
        $freelancers = $em->getRepository('AppBundle:Freelancer')->findBy(array("user"=>$user));
        $freelancer = new Freelancer();
        foreach($freelancers as $f){
            $freelancer = $f;
        }

        /*
        $free= new Freelancer();
        $job = new Jobowner();
        $form = $this->createForm('AppBundle\Form\FreelancerType', $free);
        $form2 = $this->createForm('AppBundle\Form\JobownerType', $job);*/
        return $this->render('freelancer/freelancer_home.html.twig');
    }
    public function FreelancerAction(Request $request)

    {

        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('MyAppJobOwnerBundle:Project')->findAll();
        $paginator  = $this->get('knp_paginator');

        $result= $paginator->paginate(
            $projects,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)

        );


        return $this->render('FreelancerBundle:Default:Freelancer_home.html.twig',array(
            'projects' => $result));
    }

    public function AlluserAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('FreelancerBundle:Default:Alluser.html.twig', array('users' =>   $users));
    }

}
