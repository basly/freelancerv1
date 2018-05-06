<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MobileApiController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function loginAction()
    {
        // This data is most likely to be retrieven from the Request object (from Form)
        // But to make it easy to understand ...
        $_username = $request->get('username');
        $_password = $request->get('password');

        // Retrieve the security encoder of symfony
        $factory = $this->get('security.encoder_factory');

        /// Start retrieve user
        // Let's retrieve the user by its username:
        // If you are using FOSUserBundle:
        $user_manager = $this->get('fos_user.user_manager');
        $user = $user_manager->findUserByUsername($_username);
        // Or by yourself
        $user = $this->getDoctrine()->getManager()->getRepository("userBundle:User")
            ->findOneBy(array('username' => $_username));
        /// End Retrieve user

        // Check if the user exists !
        if (!$user) {
            return new Response(
                'Username doesnt exists'
            );
        }

        /// Start verification
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();

        if (!$encoder->isPasswordValid($user->getPassword(), $_password, $salt)) {
            return new Response(
                'Username or Password not valid.',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        }
        /// End Verification

        // The password matches ! then proceed to set the user in session

        //Handle getting or creating the user entity likely with a posted form
        // The third parameter "main" can change according to the name of your firewall in security.yml
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        // If the firewall name is not main, then the set value would be instead:
        // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
        $this->get('session')->set('_security_main', serialize($token));

        // Fire the login event manually
        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        /*
         * Now the user is authenticated !!!!
         * Do what you need to do now, like render a view, redirect to route etc.
         */
        return new Response(
            'Welcome ' . $user->getUsername(),
            Response::HTTP_OK,
            array('Content-type' => 'application/json')
        );
    }

        public function ReclamationsAction()
    {
       /* $userManager = $this->get('fos_user.user_manager');
        $us = $this->getUser();
        $ty = "Reclamation";
        $user = $userManager->findUserByEmail($us->getEmail());*/
       /* $parameters = array(
            'iduser' => $iduser,
            'ty' => $ty
        );*/

        $dql = 'SELECT u
    FROM AppBundle:Reclamation u
   
   ';

        $query1 = $this->getDoctrine()->getEntityManager()->createQuery($dql)
           ;


        /*$parameters = array(
            'iduser' => $user->getId()
        );

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:Reclamation u WHERE u.iduser LIKE :iduser '
            )->setParameter('iduser',$user->getId());*/

        $reclamations = $query1->getResult();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatter = $serializer->normalize($reclamations);


        return new JsonResponse($formatter);
    }

}
