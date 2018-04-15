<?php

namespace MyApp\JobOwnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobOwnerController extends Controller

    /**
     * Lists Freelancer.
     *
     */
{
    public function jobOwnerAction()


    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM FreelancerBundle:User u WHERE u.roles LIKE :role'
            )->setParameter('role', '%"ROLE_FREELANCER"%');

        $freelancer = $query->getResult();
        $em = $this->getDoctrine()->getManager();


        return $this->render('MyAppJobOwnerBundle:Default:Jobowner_home.html.twig', array(
            'frees' => $freelancer,
        ));
    }






}
