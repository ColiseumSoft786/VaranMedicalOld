<?php

namespace DoctorsBundle\Controller;
use DataBundle\Entity\Appointments;
use DataBundle\Entity\Doctors;
use DataBundle\Entity\Dp;
use DataBundle\Entity\FosUser;
use DataBundle\Entity\Patient;
use Octopush\Api\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PatientController extends Controller
{
    public function displayAction()
    {
      $em = $this->getDoctrine()->getManager();
      $user = $this->getUser();
      $idDoctor = $user->getIdTable();
      $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);
      $dp = $this->getDoctrine()->getRepository('DataBundle:Dp')->findBy(array(
          'doctor' => $doctor
      ));
      $dp = array_reverse($dp);
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($idDoctor);

        return $this->render('DoctorsBundle:Patient:display.html.twig', array(
            'doctor' => $doctor,
            'dp' => $dp
        ));
    }
    public function detailsAction($dp,$doc){
        $doctor = $this->getDoctrine()->getRepository(Doctors::class)->find($doc);
        $dp = $this->getDoctrine()->getRepository(Dp::class)->find($dp);
        $user = $this->getDoctrine()->getRepository(FosUser::class)->findOneBy(array('idtable' => $dp->getPatient()->getId()));
        $app = $this->getDoctrine()->getRepository(Appointments::class)->findBy(array('patient' => $user));
        $apps = array();
        foreach ($app as $item){
            if ($item->getSeance()->getCalendrie()->getLocation()->getDoctor() == $doctor){
                array_push($apps,$item);
            }
        }
        usort($apps, array($this,"cmp"));
        $doctor = $this->getDoctrine()->getRepository(\DoctorsBundle\Entity\Doctors::class)->find($doc);

        return $this->render('DoctorsBundle:Patient:details.html.twig',array(
            'appointment' => $apps,
            'doctor' => $doctor,
            'user' => $user,
            'dp' => $dp,
            'patient' => $dp->getPatient()
        ));
    }
    function cmp($a, $b)
    {
        return strcmp($a->getSeance()->getCalendrie()->getDate()->format('Y-m-d H:i:s'), $b->getSeance()->getCalendrie()->getDate()->format('Y-m-d H:i:s'));
    }

    public function smsAction(){
        $ss = $this->get('SmsSending');
        $ss->reminder();
        return new Response("true");

    }

    public function changestatusAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $dp = $em->getRepository('DataBundle:Dp')->find($request->get('id'));
      if($dp->getBlock() == 0){
        $dp->setBlock(1);
      }else{
        $dp->setBlock(0);
      }
      $em->flush();

        $user = $this->getUser();
        $idDoctor = $user->getIdTable();

        return $this->redirectToRoute('patient_doctor_details',array('doc' => $idDoctor,'dp' => $dp->getId()));
    }
    public function changenameAction($id){
        $em = $this->getDoctrine()->getManager();
        $dp = $em->getRepository(Dp::class)->find($id);
        $pat = $em->getRepository(Patient::class)->find($dp->getPatient()->getId());
        $temp = $pat->getFirstname();
        $pat->setFirstname($pat->getLastname());
        $pat->setLastname($temp);
        $em->flush();

        $user = $this->getUser();
        $idDoctor = $user->getIdTable();

        return $this->redirectToRoute('patient_doctor_details',array('doc' => $idDoctor,'dp' => $id));

    }
    public function updatePatientAction(Request $request){
        if ($request->getMethod() == "POST"){

            $sd = explode("-",$request->get('dob'));
            $date = new \DateTime();
            $date->setDate($sd[0],$sd[1],$sd[2]);
            $em = $this->getDoctrine()->getManager();
            $patient = $em->getRepository(Patient::class)->find($request->get('id'));
            $patient->setAdresse($request->get('address'));
            $patient->setBirthday($date);
            $patient->setDomicile($request->get('domicile'));
            $patient->setFirstname($request->get('fname'));
            $patient->setGsm($request->get('gsm'));
            $patient->setLastname($request->get('lname'));
            $patient->setPreferrednumber($request->get('pnum'));
            $patient->setSexe($request->get('sex'));
            $patient->setTravail($request->get('travail'));
            $em->flush();


            $user = $this->getUser();
            $idDoctor = $user->getIdTable();
            return $this->redirectToRoute('patient_doctor_details',array('doc'=>$idDoctor,'dp'=> $request->get('dp')));
        }
    }
    public function downloadPatientAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);
        $dp = $this->getDoctrine()->getRepository('DataBundle:Dp')->findBy(array(
            'doctor' => $doctor
        ));
        $rows = array();
        $row  = "First Name,Last Name,GSM,Travail,Preferred Number,Sexe,Adresse";
        array_push($rows,$row);
        foreach ($dp as $item){
            $pat = $em->getRepository(Patient::class)->find($item->getPatient()->getId());
            $row  = $pat->getFirstname().",".$pat->getLastname().",".$pat->getGsm().",".$pat->getTravail().",".$pat->getPreferredNumber().",".$pat->getSexe().",".$pat->getAdresse();
            array_push($rows,$row);
        }
        $content = implode("\n", $rows);
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        return $response;
    }
  }
