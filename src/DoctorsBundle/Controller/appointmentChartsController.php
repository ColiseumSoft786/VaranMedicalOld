<?php

namespace DoctorsBundle\Controller;

use DataBundle\Entity\Detailstatistic;
use DataBundle\Entity\Statistic;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
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
    public function AppointmentChartAction(Request $request)
    {
        if($request->getMethod() == 'GET')
        {
            $statArray = [];
            $DstatArray = [];
            $matchedData = [];
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
            $startDate = new \DateTime($request->get('sdate'));
            $endDate = new \DateTime($request->get('edate'));
            $dateRange  = date_diff($startDate,$endDate)->days;
//            return $this->render('Appointmentcharts/chart.html.twig',['s'=>'']);
            foreach ($DstatArray as $dValue)
            {
                foreach ($dValue as $dStatValue)
                {

                        for ($i=0; $i<=$dateRange; $i++)
                        {
                            $date = strtotime("$i day", strtotime($request->get('sdate')));
                            $checkDate = date("Y-m-d", $date);
                            if($dStatValue->getDate() == $checkDate)
                            {
                                array_push($matchedData,$dStatValue);
                            }


                        }
                }
            }


            return $this->render('Appointmentcharts/chart.html.twig',['chartDisplay'=> $matchedData]);
        }
        return $this->render('Appointmentcharts/chart.html.twig');
    }
//    public function AppointmentNumberAction()
//    {
//        $statArray = [];
//        $DstatArray = [];
//        $doc = $this->getUser();
//        $docId = $doc->getIdTable();
//        $stat = $this->getDoctrine()->getRepository(Statistic::class)->findBy(array('doctor' => $docId));
//        foreach ($stat as $item)
//        {
//            $StatId = $item->getId();
//            array_push($statArray,$StatId);
//        }
//
//        foreach ($statArray as $value)
//        {
//            $dStat = $this->getDoctrine()->getRepository(Detailstatistic::class)->findBy(array('statistic' => $value));
//            array_push($DstatArray,$dStat);
//        }
//
//        return $this->render('Appointmentcharts/noOfAppointments.html.twig',['StatChart'=>$DstatArray]);
//    }

}
