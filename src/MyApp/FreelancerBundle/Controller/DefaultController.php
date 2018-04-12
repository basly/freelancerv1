<?php

namespace MyApp\FreelancerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{


    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM FreelancerBundle:User u WHERE u.roles LIKE :role'
            )->setParameter('role', '%"ROLE_FREELANCER"%');

        $freelancers = $query->getResult();
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM FreelancerBundle:User u WHERE u.roles LIKE :role'
            )->setParameter('role', '%"ROLE_JOBOWNER"%');

        $Jobowners = $query->getResult();

        return $this->render('@Freelancer/Default/index.html.twig',array('freelancers' =>   $freelancers,'Jobowners'=>$Jobowners));
    }



}
