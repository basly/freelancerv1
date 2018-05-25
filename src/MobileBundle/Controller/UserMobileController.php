<?php
/**
 * Created by PhpStorm.
 * User: Yora
 * Date: 06/05/2018
 * Time: 12:54
 */

namespace MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use MyApp\FreelancerBundle\Entity\User;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserMobileController extends Controller{

    ///se connecter à traver l'application
    public function getUserAction($login, $password)
    {
        /*$errors = [];
        $errors[] = 'succ';
    */
        $passwordEncoder = $this->get('security.password_encoder');
        $serializer = new   Serializer([new ObjectNormalizer()]);
        $user = $this->getDoctrine()->getManager()
            ->getRepository('FreelancerBundle:User')
            ->findBy(array("username" => $login));
        if (!$passwordEncoder->isPasswordValid($user[0], $password, $user[0]->getSalt())) {
            $formatted = $serializer->normalize('erreur', 'json');
            return new JsonResponse($formatted);
        }
        else{
            $formatted = $serializer->normalize($user, 'json');
            return new JsonResponse($formatted);
        }
    }

}