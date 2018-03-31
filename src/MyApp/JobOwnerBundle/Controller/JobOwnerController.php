<?php

namespace MyApp\JobOwnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobOwnerController extends Controller
{
    public function jobOwnerAction()
    {
        return $this->render('MyAppJobOwnerBundle:Default:Jobowner_home.html.twig');
    }
}
