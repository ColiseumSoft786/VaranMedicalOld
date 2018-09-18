<?php

namespace AppointmentsBundle\Controller;

use DataBundle\Entity\Blockdays;
use DataBundle\Entity\Unblockday;
use DataBundle\Entity\Unblockph;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HolidayController extends Controller
{
    public function displayAction(){
        $em = $this->getDoctrine();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($idDoctor);
        $weekends = $this->getDoctrine()->getRepository('DataBundle:Blockdays')->findAll();
        $pha = $em->getRepository('DataBundle:Publicholiday')->findAll();
        $unb = $this->getDoctrine()->getRepository('DataBundle:Unblockph')->findBy(
            array(
                'doctor' => $doctor,
            ));
        return $this->render('AppointmentsBundle:Holiday:display.html.twig',
            array(
                'doctor' => $doctor,
                'pha' => $pha,
                'unb' => $unb,
                'weekend' => $weekends
            ));
    }
    public function changestatusAction(Request $request){
        $em = $this->getDoctrine();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);

        $pub = $this->getDoctrine()->getRepository('DataBundle:Publicholiday')->find($request->get('id'));
        $unb = $this->getDoctrine()->getRepository('DataBundle:Unblockph')->findOneBy(
            array(
               'doctor' => $doctor,
                'ph' => $pub
            ));
        $em = $this->getDoctrine()->getManager();
        if ($unb == null){
            $newunb = new Unblockph();
            $newunb->setDoctor($doctor);
            $newunb->setPh($pub);
            $em->persist($newunb);
            $em->flush();
            return new Response('block');
        }else{
            $em->remove($unb);
            $em->flush();
            return new Response('unblock');
        }

    }
    public function addweekendAction(Request $request){
        $em = $this->getDoctrine();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($idDoctor);
        if ($request->getMethod() == "POST"){
            $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);
            $weekend = new Blockdays();
            $weekend->setDoctor($doctor);
            $weekend->setDay($request->get('day'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($weekend);
            $em->flush();
            return $this->redirect($this->generateUrl('holiday_display'));
        }
        return $this->render('AppointmentsBundle:Holiday:addweekend.html.twig',
            array(
                'doctor' => $doctor
            ));
    }
    public function deleteweekendAction($id){
        $em = $this->getDoctrine()->getManager();
        $admin = $this->getDoctrine()->getRepository('DataBundle:Blockdays')->find($id);
        $em->remove($admin);
        $em->flush();
        return $this->redirect($this->generateUrl('holiday_display'));
    }
    public function unblockWeekEndAction(Request $request){
        $em = $this->getDoctrine();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);
        $add = false;
        if($request->getMethod() == "POST"){
            $unb = new Unblockday();
            $unb->setDoctor($doctor);
            $unb->setDate($request->get('date'));
            $em = $em->getManager();
            $em->persist($unb);
            $em->flush();
            $add=true;
        }
        $unbd = $this->getDoctrine()->getRepository('DataBundle:Unblockday')->findBy(array(
            'doctor' => $doctor
        ));
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($idDoctor);

        return $this->render('AppointmentsBundle:Holiday:unblockweekend.html.twig',array(
            'doctor' => $doctor,
            'days' => $unbd,
            'add' => $add
        ));
    }
    public function deleteunblockdayAction($id){
        $em= $this->getDoctrine()->getManager();
        $unb = $em->getRepository('DataBundle:Unblockday')->find($id);
        $em->remove($unb);
        $em->flush();
        return $this->redirect($this->generateUrl('holiday_weekend_unblock'));
    }
    public function getdetailofselecteddateAction(Request $request){
        $sd = explode("-",$request->get('date'));
        $date = new \DateTime();
        $date->setDate($sd[0],$sd[1],$sd[2]);
        $em = $this->getDoctrine();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);
        $weekend = $this->getDoctrine()->getRepository('DataBundle:Blockdays')->findBy(array(
            'doctor' => $doctor
        ));
        $day = $date->format('l');
        foreach ($weekend as $item) {
            if($item->getDay() == $day){
                $unbd = $this->getDoctrine()->getRepository('DataBundle:Unblockday')->findOneBy(array(
                    'doctor' => $doctor,
                    'date' => $request->get('date')
                ));
                if($unbd == null){
                    return new Response('true');
                }else{
                    return new Response('found');
                }
            }
        }
        return new Response('false');
    }
}
