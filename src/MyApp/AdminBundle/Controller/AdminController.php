<?php

namespace MyApp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Replyreclamation;
use AppBundle\Form\ReplyreclamationType;
use AppBundle\Entity\Reclamation;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ReclamationType;

class AdminController extends Controller
{
    public function adminAction()
    {
        return $this->render('MyAppAdminBundle:Default:Admin_home.html.twig');
    }
    public function ShowReclamationsAction()
    {

        $ty="Reclamation";
        $parameters = array(
            'ty' => $ty,
            'created'=>"Created",
            'inprogress'=>"InProgress"
        );

        $dql = 'SELECT u
    FROM AppBundle:Reclamation u
    WHERE u.type =:ty AND (u.statue= :created or u.statue=:inprogress
    )
   ';

        $query1 = $this->getDoctrine()->getEntityManager()->createQuery($dql)
            ->setParameters($parameters);
        $reclamations = $query1->getResult();
        return $this->render('@MyAppAdmin/Default/Reclamations.html.twig',array('reclamations' =>   $reclamations));
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

            return $this->render('@MyAppAdmin/Default/showReclamation.html.twig', array('rec' =>$reclamation,'form'=>$formview,'replys'=>$replys,'admin'=>$admin,'user'=>$user));

        }

        return $this->render('@MyAppAdmin/Default/showReclamation.html.twig', array('rec' =>$reclamation,'form'=>$formview,'replys'=>$replys,'admin'=>$admin,'user'=>$user));
    }

}
