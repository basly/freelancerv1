<?php

namespace MyApp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppAdminBundle:Default:index.html.twig');
    }

    public function adminAction()
    {
        return $this->render('MyAppAdminBundle:Default:Admin_home.html.twig');
    }
}
