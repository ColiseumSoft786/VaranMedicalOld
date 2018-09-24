<?php

namespace DoctorsBundle\Controller;

use DataBundle\Entity\Detailstatistic;
use DataBundle\Entity\Statistic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class appointmentChartsController extends Controller
{
    public function AppointmentNumberAction()
    {
        $doc = $this->getUser();
        $docId = $doc->getIdTable();
        $stat = $this->getDoctrine()->getRepository(Statistic::class)->findOneBy(array('doctor' => $docId));
        $StatId = $stat->getId();
        if($stat->getStatname() == 'Appointment')
        {
          $dStat = $this->getDoctrine()->getRepository(Detailstatistic::class)->findBy(array('statistic' => $StatId));
          return $this->render('Appointmentcharts/noOfAppointments.html.twig',['StatChart'=>$dStat]);
        }
        return $this->render('Appointmentcharts/noOfAppointments.html.twig');
    }

}
