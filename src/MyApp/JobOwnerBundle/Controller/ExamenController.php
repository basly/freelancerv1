<?php

namespace MyApp\JobOwnerBundle\Controller;
use JMS\Serializer\SerializerBuilder;
use MyApp\JobOwnerBundle\Entity\Examen;
use MyApp\JobOwnerBundle\Entity\Question;
use MyApp\JobOwnerBundle\Entity\Choix;
use MyApp\JobOwnerBundle\Entity\Tests;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ExamenController extends Controller
{

    public function newAction($id)
    {
        return $this->render('MyAppJobOwnerBundle::examen/new_exam.html.twig',array("project"=>$id));
    }

    public function getAction($id)
    {
        //connexion
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('MyAppJobOwnerBundle:Project')->find($id);
        $exs = $em->getRepository('MyAppJobOwnerBundle:Examen')->findBy(array("project"=>$project));
        $examen = new Examen();
        foreach($exs as $e){
            $examen = $e;
        }
        $questions = $em->getRepository('MyAppJobOwnerBundle:Question')->findBy(array("examen"=>$examen));

        $i=0;
        $choix = array();
        foreach($questions as $q){
            $i++;
            $choix[$i] = $em->getRepository('MyAppJobOwnerBundle:Choix')->findBy(array("question"=>$q));
        }
        return $this->render('MyAppJobOwnerBundle::examen/get_exam.html.twig',array("project"=>$id,"examen"=>$examen,"questions"=>$questions,"choix"=>$choix));

    }
    public function examAction(Request $request)
    {

        //connexion
        $em = $this->getDoctrine()->getManager();

        $status = 'erreur';
        $html = 'erreur';

        if ($request->isMethod('POST'))
        {

            if($request->isXmlHttpRequest()) {

                //extraire les données de l'examen
                $pr = $request->request->get('project');
                //extraire l'project via l'utilisateur connectée
                $project = $em->getRepository('MyAppJobOwnerBundle:Project')->find($pr);

                $titre = $request->request->get('titre');
                $desc = $request->request->get('description');
                $date = $request->request->get('date');
                //nouveau examen
                $examen = new Examen();
                //$examen->setDateEx($date);
                $examen->setDateEx(new \DateTime($date));
                $examen->setDescription($desc);
                $examen->setTitre($titre);
                $examen->setEtat("Active");
                $examen->setProject($project);
                //ajouter l'examen
                $em->persist($examen);

                //$em->flush();

                for($i=1;$i<=5;$i++){
                    //extraire l'enonce
                    $enonce = $request->request->get('enonce'.$i);
                    //ajouter la question
                    $question = new Question();
                    $question->setQuestion($enonce);
                    $question->setExamen($examen);
                    //ajouter la question
                    $em->persist($question);
                    //ajouter les réponses a la question ajoutée
                    for($j=1;$j<=3;$j++){

                        $rep = $request->request->get('rep'.$i.$j);

                        $valide = $request->request->get('valide'.$i);
                        $choix = new Choix();
                        if($valide == 'r'.$j){
                            $choix->setEtat('Valide');
                        }else{
                            $choix->setEtat('Errone');
                        }
                        $choix->setReponse($rep);
                        $choix->setQuestion($question);
                        //ajouter la reponse de la question
                        $em->persist($choix);
                    }

                }
                if($pr!=null&&$project!=null){
                    $data = $this->render('MyAppJobOwnerBundle::examen/exam.html.twig', array(
                        'titre'=>$titre,'date'=>$date,'desc'=>$desc
                    ));
                    $status = 'success';
                    $html = $data->getContent();
                }

            }
        }

        $em->flush();



        $jsonArray = array(
            'status' => $status,
            'data' => $html,
        );

        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;
        // return $this->render('project/examen/new_exam.html.twig');

    }
    public function passAction(Request $request)
    {

        //connexion
        $em = $this->getDoctrine()->getManager();

        $status = 'erreur';
        $html = '';
        $valide = false;
        if ($request->isMethod('POST')) {

            if ($request->isXmlHttpRequest()) {

                //entrée valide
                $valide = true;
                //extraire les données de l'url
                $pr = $request->request->get('project');
                $project = $em->getRepository('MyAppJobOwnerBundle:Project')->find($pr);
                $ex = $request->request->get('exam');
                $examen = $em->getRepository('MyAppJobOwnerBundle:Examen')->find($ex);
                $score = $request->request->get('score');
                $duration = $request->request->get('duration');
                var_dump($duration);
                //le freelancer connecté
                $user = $this->getUser();


                $test = new Tests();
                $test->setExamen($examen);
                $test->setFreelancer($user);
                $test->setTestdescription($score);
                $test->setTestdate(new \DateTime());
                $test->setDuration($duration);

                $em->persist($test);


            }
        }

        if($valide){
            $data = $this->render('MyAppJobOwnerBundle::examen/result.html.twig', array(
                'titre'=>$examen->getTitre(),'score'=>$test->getTestdescription(),'duration'=>$test->getDuration()
            ));
            $status = 'success';
            $html = $data->getContent();
            $em->flush();
        }





        $jsonArray = array(
            'status' => $status,
            'data' => $html,
        );

        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;
    }

    public function allexamapiAction()
    {
        $tasks=$this->getDoctrine()->getManager()->getRepository('MyApp\JobOwnerBundle\Entity\Examen')->findAll();
        $serializer = SerializerBuilder::create()->build();
        $formatted = $serializer->serialize($tasks, 'json');
        return new JsonResponse($formatted);

    }



}
