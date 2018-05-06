<?php

namespace MyApp\JobOwnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppJobOwnerBundle:Default:Jobowner_home.html.twig');
    }

    public function mailerAction($name)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('freelancer@example.com')
            ->setTo('walid.hnaien@esprit.tn')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'MyAppJobOwnerBundle:Default:email.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;

        $this->get('mailer')->send($message);
        // $mailer->send($message);

        // or, you can also fetch the mailer service this way
        // $this->get('mailer')->send($message);

        return new Response('<html<body>Sent</body></html>');
    }



}
