<?php

namespace PatientBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DoctorController extends Controller
{
    public function displayAction()
    {
      $em= $this->getDoctrine()->getManager();
        $patient = $em->getRepository('DataBundle:Patient')->find($this->getUser()->getIdTable());
        $dp = $em->getRepository('DataBundle:Dp')->findBy(array(
          'patient' => $patient
        ));
        $patient = $em->getRepository('PatientBundle:Patient')->find($this->getUser()->getIdTable());

        return $this->render('PatientBundle:Doctor:display.html.twig', array(
            'dp' => $dp,
            'patient' =>$patient
        ));
    }
    public function reviewAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $dp = $em->getRepository('DataBundle:Dp')->find($request->get('id'));
        $dp->setReview($request->get('review'));
        $em->flush();
        return $this->redirectToRoute('doctor_managment_display');

    }

}
