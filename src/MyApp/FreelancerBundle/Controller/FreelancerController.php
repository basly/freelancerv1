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
    public function FreelancerAction()
    {
        return $this->render('FreelancerBundle:Default:Freelancer_home.html.twig');
    }


    public function showfreelancerAction($email)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByEmail($email);

        return $this->render('@Freelancer/Default/Freelancersdetails.html.twig', array('user' =>$user));
    }
    public function showjobownerAction($email)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByEmail($email);

        return $this->render('@Freelancer/Default/Freelancersdetails.html.twig', array('user' =>$user));
    }
    public function EditprofileAction(Request $request)
    {
        $firstname = $request->request->get('firstname');
        $lastname = $request->request->get('lastname');
        $skills = $request->request->get('skills');
        $Phone = $request->request->get('phone');
        $email = $request->request->get('email');
        $filre = array('email' => $email);
        $currentuser = $this->getDoctrine()->getRepository('FreelancerBundle:User')->findOneBy($filre);
        $currentuser->setFirstName($firstname);
        $currentuser->setLastName($lastname);
        $currentuser->setPhoneNumber($Phone);
        $currentuser->setSkills($skills);
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByEmail($email);
        return $this->render('@Freelancer/Default/Freelancersdetails.html.twig', array('user' =>$user));
    }
}
