<?php

namespace AdminBundle\Controller;

use DataBundle\Entity\Holidaysadmin;
use DataBundle\Entity\Publicholiday;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HolidayController extends Controller
{
    private $loggedin = false;
    private $user = null;
    public function __construct()
    {
        if(isset($_SESSION['user'])){
            $this->user = $_SESSION['user'];
            $this->loggedin = true;
        }
    }
    //weekendView
    public function indexAction()
    {
        $weekend = $this->getDoctrine()->getRepository('DataBundle:Holidaysadmin')->findAll();
        return $this->render('AdminBundle:Holiday:index.html.twig', array(
            'weekend' => $weekend
        ));
    }
    public function addweekendAction(Request $request){
        if($request->getMethod() == "POST"){
            $admin = $this->getDoctrine()->getRepository('DataBundle:Admin')->find($this->user->getId());
            $weekend = new Holidaysadmin();
            $weekend->setAdmin($admin);
            $weekend->setDay($request->get('day'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($weekend);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_holiday_index_weekend'));

        }
        return $this->render('AdminBundle:Holiday:addweekend.html.twig');
    }
    public function deleteweekendAction($id){
        $em = $this->getDoctrine()->getManager();
        $admin = $this->getDoctrine()->getRepository('DataBundle:Holidaysadmin')->find($id);
        $em->remove($admin);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_holiday_index_weekend'));
    }
    //publicholidayView
    public function publicholidaysAction(){
        $holi = $this->getDoctrine()->getRepository('DataBundle:Publicholiday')->findAll();
        $holi= array_reverse($holi);
        return $this->render('AdminBundle:Holiday:publicholiday.html.twig', array(
            'holi' => $holi
        ));
    }
    public function addphAction(Request $request){
        if($request->getMethod() == "POST"){
            $admin = $this->getDoctrine()->getRepository('DataBundle:Admin')->find($this->user->getId());
            $ph = new Publicholiday();
            $ph->setAdmin($admin);
            $ph->setDate($request->get('date'));
            $ph->setReason($request->get('reason'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($ph);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_holiday_index_pHoliday'));

        }
        return $this->render('AdminBundle:Holiday:addph.html.twig');
    }
    public function deletephAction($id){
        $em = $this->getDoctrine()->getManager();
        $ph = $this->getDoctrine()->getRepository('DataBundle:Publicholiday')->find($id);
        $unbbydoctor= $this->getDoctrine()->getRepository('DataBundle:Unblockph')->findBy(array(
            'ph' => $ph
        ));
        foreach($unbbydoctor as $item){
            $em->remove($item);
            $em->flush();
        }

        $em->remove($ph);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_holiday_index_pHoliday'));
    }

}
