<?php

namespace MyApp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function adminAction()
    {
        return $this->render('MyAppAdminBundle:Default:Admin_home.html.twig');
    }
}
