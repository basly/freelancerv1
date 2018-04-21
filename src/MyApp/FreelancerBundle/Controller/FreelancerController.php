<?php

namespace MyApp\FreelancerBundle\Controller;

use AppBundle\Entity\Reclamation;
use AppBundle\Entity\Replyreclamation;
use AppBundle\Entity\Subscriber;
use AppBundle\Form\ReplyreclamationType;
use AppBundle\Form\ReclamationType;
use MyApp\FreelancerBundle\Entity\User;
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
        $parameters = array(
            'iduser' => $this->getUser()->getId(),
            'idsubscriber' => $user->getId()
        );
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:Subscriber u WHERE u.iduser = :iduser and u.idsubscriber=:idsubscriber'
            )->setParameters($parameters);

        $subscription = $query->getResult();
        if ($subscription==null ||$subscription="")
        {return $this->render('@Freelancer/Default/Freelancersdetails.html.twig', array('user' =>$user,'issubscribed'=>"false"));}else
            {
                return $this->render('@Freelancer/Default/Freelancersdetails.html.twig', array('user' =>$user,'issubscribed'=>"true"));
            }
        return $this->render('@Freelancer/Default/Freelancersdetails.html.twig', array('user' =>$user));
    }
    public function showjobownerAction($email)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByEmail($email);

        return $this->render('@Freelancer/Default/Jobownersdetails.html.twig', array('user' =>$user));
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
        if($firstname!=null||$firstname!=""){
        $currentuser->setFirstName($firstname);
        }
        if($lastname!=null||$lastname!="") {
            $currentuser->setLastName($lastname);
        }
        if($Phone!=null||$Phone!="") {
            $currentuser->setPhoneNumber($Phone);
        }
            if($skills!=null||$skills!="") {
                $currentuser->setSkills($skills);
            }
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByEmail($email);
        return $this->render('@Freelancer/Default/Freelancersdetails.html.twig', array('user' =>$user));
    }

    public function ReclamationsAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $us = $this->getUser();
        $ty="Reclamation";
        $user = $userManager->findUserByEmail($us->getEmail());
        $parameters = array(
            'iduser' => $user->getId(),
            'ty' => $ty
        );

        $dql = 'SELECT u
    FROM AppBundle:Reclamation u
    WHERE u.iduser=:iduser 
    AND u.type =:ty 
   ';

        $query1 = $this->getDoctrine()->getEntityManager()->createQuery($dql)
            ->setParameters($parameters);



        /*$parameters = array(
            'iduser' => $user->getId()
        );

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:Reclamation u WHERE u.iduser LIKE :iduser '
            )->setParameter('iduser',$user->getId());*/

        $reclamations = $query1->getResult();


        return $this->render('@Freelancer/Default/Reclamations.html.twig',array('reclamations' =>   $reclamations));
    }
    public function createreclamationAction(Request $request)
    {
        $reclamation=new Reclamation();
        $form=$this->createForm(ReclamationType::class, $reclamation);
        $formview =$form->createView();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $save=$this->getDoctrine()->getManager();
            $this->get('session')->getFlashBag()->add(
                'notice','Reclamation sended to administrator'
                );
            $reclamation->setIduser($this->getUser()->getId());
            $reclamation->setType("Reclamation");
            $reclamation->setCreationdate(new \DateTime('now'));
            $reclamation->setStatue("Created");
                $save->persist($reclamation);
            $save->flush();
            return $this->render('@Freelancer/Default/index.html.twig');
        }
        return $this->render('@Freelancer/Default/CreateReclamation.twig',array('form'=>$formview));
    }
    public function showReclamationAction(Request $request,$id)
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM FreelancerBundle:User u WHERE u.roles LIKE :role'
            )->setParameter('role', '%"ROLE_ADMIN"%');

        $admin = $query->getResult();
        $parameters = array(
            'idreclamation' => $id
        );

        $dql = 'SELECT u
    FROM AppBundle:Replyreclamation u
    WHERE u.idreclamation=:idreclamation 
    
   ';

        $query1 = $this->getDoctrine()->getEntityManager()->createQuery($dql)
            ->setParameters($parameters);


        $replys = $query1->getResult();

        $reclamation = $this->getDoctrine()->getRepository('AppBundle:Reclamation')->find($id);
        $user = $this->getDoctrine()->getRepository('FreelancerBundle:User')->find($reclamation->getIduser());
        $reply=new Replyreclamation();
        $form=$this->createForm(ReplyreclamationType::class, $reply);
        $formview =$form->createView();
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid())
        {
            $save=$this->getDoctrine()->getManager();
            $this->get('session')->getFlashBag()->add(
                'notice','Reclamation sended to administrator'
            );
            $reply->setIduser($this->getUser()->getId());
            $reply->setIdreclamation($id);
            $save->persist($reply);
            $save->flush();

            return $this->render('@Freelancer/Default/showReclamation.html.twig', array('rec' =>$reclamation,'form'=>$formview,'replys'=>$replys,'admin'=>$admin,'user'=>$user));

        }

        return $this->render('@Freelancer/Default/showReclamation.html.twig', array('rec' =>$reclamation,'form'=>$formview,'replys'=>$replys,'admin'=>$admin,'user'=>$user));
    }
    public function SubscribeAction($idsubscriber){
        $user = $this->getDoctrine()->getRepository('FreelancerBundle:User')->find($this->getUser()->getId());
        $subscription=new Subscriber();
        $save=$this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'notice','Reclamation sended to administrator'
        );
        $subscription->setIduser($this->getUser()->getId());
        $subscription->setIdsubscriber($idsubscriber);
        $subscription->setCreatedAt(new \DateTime('now'));
        $save->persist($subscription);
        $save->flush();


        return $this->redirectToRoute('freelancer_homepage');
    }
    public function UnSubscribeAction($idsubscriber){
        $user = $this->getDoctrine()->getRepository('FreelancerBundle:User')->find($this->getUser()->getId());
        $subscription=new Subscriber();
        $save=$this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'notice','Reclamation sended to administrator'
        );
        $save->remove($subscription);
        $save->flush();
        return $this->redirectToRoute('freelancer_homepage');
    }
}
