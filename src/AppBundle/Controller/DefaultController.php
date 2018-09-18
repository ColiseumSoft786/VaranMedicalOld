<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
//        $em = $this->getDoctrine()->getManager();
//        $request = $this->container->get('request_stack')->getCurrentRequest();
//        $user = $this->getUser();
//        $doctorId = $user->getIdTable();
//        var_dump($doctorId);
//        
//        
        
        

        
        //--------------------- Pour les Docteurs ------------------------------------------------
        
        //on recupere la langitude et la latitude
        $ip  =  $_SERVER['REMOTE_ADDR'];
        
        $url = "http://freegeoip.net/json/".$ip;
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        curl_close($ch);
        $lat = /*$location->latitude*/31.418727;
        $lon = /*$location->longitude*/73.079091;
        if ($data) {
            $location = json_decode($data);
            $lat = /*$location->latitude*/31.418727;
            $lon = /*$location->longitude*/73.079091;
        }
        
        
        //s'il existe des docteurs proche d'une certain distance
        $em = $this->getDoctrine()->getManager();
        $doctors = $em->getRepository('DoctorsBundle:Doctors')->getDoctorsByLonLat($lon,$lat);
        
        if(!$doctors){ // sinon on cherche les docteurs qui des rendez vous max
            $doctors = $em->getRepository('DoctorsBundle:Doctors')->getDoctorsByMaxRDV();
        }
        //----------------------------------------------------------------------------------------


        //--------------------- Pour les Commentaires --------------------------------------------
        //on peut les afficher en fonction de lieu d'habitation du client 
        //et si personne n'est pas connectée on affiche les docteurs avec ceux qui ont plus de RDV  

        //on recupere la ville du client
        

        $city = /*$location->city*/"Faisalabad";
        
        $dataComments = $em->getRepository('DoctorsBundle:Locations')->getCommentsByCity($city);
        
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') || empty($dataComments)) {
            $dataComments = $em->getRepository('DoctorsBundle:Locations')->getCommentsByMaxRDV();
        }
        return $this->render('default/homepage.html.twig', 
                           array(
                                 'dataComments' => $dataComments,
                                 'doctors' => $doctors,
                                 ['base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,]
                            ));
        
    }
    
    public function headerAction(){
        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_PATIENT')) {
            $user = $this->getUser();
            $patientId = $user->getIdTable();
            $patient = $this->getDoctrine()->getRepository('PatientBundle:Patient')->find($patientId);
            return $this->render('default/header.html.twig', array(
                'patientH' => $patient,
            )); 
        } else if (true === $this->get('security.authorization_checker')->isGranted('ROLE_DOCTOR')){
            $user = $this->getUser();
            $doctorId = $user->getIdTable();
            $doctor = $this->getDoctrine()->getRepository('DoctorsBundle:Doctors')->find($doctorId);
            return $this->render('default/header.html.twig', array(
                'doctorH' => $doctor,
            )); 
        }else{
            return $this->render('default/header.html.twig'); 
        }
        
        
        
    }
}
