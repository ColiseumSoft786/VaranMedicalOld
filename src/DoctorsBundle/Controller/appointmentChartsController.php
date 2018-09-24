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
        $statArray = [];
        $DstatArray = [];
        $doc = $this->getUser();
        $docId = $doc->getIdTable();
        $stat = $this->getDoctrine()->getRepository(Statistic::class)->findBy(array('doctor' => $docId));
        foreach ($stat as $item)
        {
         $StatId = $item->getId();
         array_push($statArray,$StatId);
        }

        foreach ($statArray as $value)
        {
            $dStat = $this->getDoctrine()->getRepository(Detailstatistic::class)->findBy(array('statistic' => $value));
            array_push($DstatArray,$dStat);
        }

       return $this->render('Appointmentcharts/noOfAppointments.html.twig',['StatChart'=>$DstatArray]);
    }

}
