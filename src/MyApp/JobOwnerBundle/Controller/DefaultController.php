<?php

namespace MyApp\JobOwnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppJobOwnerBundle:Default:index.html.twig');
    }

}
