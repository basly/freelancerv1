<?php

namespace MyApp\JobOwnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppJobOwnerBundle:Default:Jobowner_home.html.twig');
    }

}
