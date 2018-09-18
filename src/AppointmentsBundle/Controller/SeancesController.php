<?php

namespace AppointmentsBundle\Controller;

use AppointmentsBundle\Entity\Seances;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Seance controller.
 *
 */
class SeancesController extends Controller
{

    public function getHeurFinAction($heurDebut, $durre){
        $h1 = explode(":", $heurDebut);
        $h2 = explode(":", $durre);
        $heurFin = date('H:i', mktime($h1[0]+$h2[0],$h1[1]+$h2[1],$h1[2]+$h2[2],1,1,2012));
        return new Response($heurFin);
    }

    public function getSeancesByDoctorAction($location){
        $em = $this->getDoctrine()->getManager();

//        $calendries = $em->getRepository('AppointmentsBundle:Calendries')->getWeekSeancesByDoctor($doctor);
        $location = $this->getDoctrine()->getRepository('DataBundle:Locations')->findBy(
            array(
                'id' => $location,
                'public' => 1,
                'deletedat' => null
            ));


        $today = new \DateTime();
        $calendries = $this->getDoctrine()->getRepository('DataBundle:Calendries')->findBy(
            array('location' => $location)
        );
        $temp = array();
        foreach ($calendries as $item) {

            if($item->getDate() >= $today){
                array_push($temp,$item);
            }
        }
        $calendries =  $temp;

        usort($calendries,function($a,$b){
            return strcmp($a->getDate()->format('Y-m-d H:i:s'), $b->getDate()->format('Y-m-d H:i:s'));
        });
        return $this->render('seances/weekSeancesByLocation.html.twig', array(
            'calendries' => $calendries,
        ));
    }
    public function getSeacesByCalendarAction($calendar){
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('AppointmentsBundle:Seances')->getSeacesByCalendar($calendar);
        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($calendar);
        $user =  $this->getUser()->getIdTable();
        $durree = $em->getRepository('AppointmentsBundle:Settings')->findBy(array('doctor' => $user));
        return $this->render('seances/listeSeancesCalendar.html.twig', array(
            'seances' => $seances,
            'calendrie' => $calendrie,
            'durre' => $durree[0]->getDurreAppointment(),
            'now' => date('d-m-Y'),
        ));
    }

    public function getSeacesByCalendarEditableAction($calendar){
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('AppointmentsBundle:Seances')->getSeacesByCalendar($calendar);
        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($calendar);
        $user =  $this->getUser()->getIdTable();
        $durree = $em->getRepository('AppointmentsBundle:Settings')->findBy(array('doctor' => $user));
        return $this->render('seances/listOfSeances.html.twig', array(
            'seances' => $seances,
            'calendrie' => $calendrie,
        ));
    }

    public function getSeacesByCalendarAppointementsAction($calendar){
            $em = $this->getDoctrine()->getManager();

            $seances = $em->getRepository('AppointmentsBundle:Seances')->getSeacesByCalendar($calendar);
            $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($calendar);
            return $this->render('seances/listOfSeancesOfAppointements.html.twig', array(
                'seances' => $seances,
                'calendrier' => $calendrie,
            ));
        }

    public function getNbrOfSeancesActiveAction($calendrie){
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('AppointmentsBundle:Seances')->findBy(array('calendrie' => $calendrie, 'dispo' => 1));

        $nbr = sizeof($seances);
        return new Response($nbr);
    }



    /**
     * Lists all seance entities.
     *
     */
    public function indexAction($calendrie)
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('AppointmentsBundle:Seances')->findAll();
        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($calendrie);
        $idDoctor = $this->getUser()->getIdTable();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($idDoctor);
        return $this->render('seances/index.html.twig', array(
            'seances' => $seances,
            'calendrie' => $calendrie,
            'doctor' => $doctor
        ));
    }

    /**
     * Creates a new seance entity.
     *
     */
    public function newAction(Request $request, $calendrie)
    {
        $seance = new Seances();
        $form = $this->createForm('AppointmentsBundle\Form\SeancesType', $seance);
        $form->handleRequest($request);
        $calendrie = $this->getDoctrine()->getRepository('AppointmentsBundle:Calendries')->find($calendrie);

        return $this->render('seances/new.html.twig', array(
            'calendrie' => $calendrie,
            'seance' => $seance,
            'form' => $form->createView(),
            'success' => 'non'
        ));
    }

    /**
     * Finds and displays a seance entity.
     *
     */
    public function showAction(Seances $seance)
    {
        $deleteForm = $this->createDeleteForm($seance);

        return $this->render('seances/show.html.twig', array(
            'seance' => $seance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function takeAppointementAction($id)
    {
        if ($id != null){
            return $this->redirect('appointments_new', array('seance' => $id));
        }else{
            return new Response();
        }
    }

    public function verifierHeurDebutAction($heurDebut, $heurFin, $calendrie)
    {
        $em = $this->getDoctrine()->getManager();
        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($calendrie);
        $date = $calendrie->getDate()->format('Y-m-d');
        $doctor= $this->getUser()->getIdTable();
        $seances = $em->getRepository('AppointmentsBundle:Seances')->verifierHeurDebut($heurDebut, $date, $heurFin, $doctor);
        if ($seances != null){
            return new Response('exist');
        }else{
            return new Response('notExist');
        }
    }

    public function verifierHeurFinAction($heurFin, $calendrie)
    {
        $em = $this->getDoctrine()->getManager();
        $seances = $em->getRepository('AppointmentsBundle:Seances')->verifierHeurFin($heurFin, $calendrie);
        if ($seances != null){
            return new Response('exist');
        }else{
            return new Response('notExist');
        }
    }

    /**
     * Displays a form to edit an existing seance entity.
     *
     */
    public function editAction(Request $request, Seances $seance)
    {
        $deleteForm = $this->createDeleteForm($seance);
        $editForm = $this->createForm('AppointmentsBundle\Form\SeancesType', $seance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seances_edit', array('id' => $seance->getId()));
        }

        return $this->render('seances/edit.html.twig', array(
            'seance' => $seance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seance entity.
     *
     */
    public function deleteAction(Request $request, Seances $seance)
    {

        $cal = $seance->getCalendrie()->getId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($seance);
        $em->flush();

        return $this->redirectToRoute('seances_index',array('calendrie' => $cal));
    }

    /**
     * Creates a form to delete a seance entity.
     *
     * @param Seances $seance The seance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seances $seance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seances_delete', array('id' => $seance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function addSeancesAction(Request $request)
    {
        $seance = new Seances();

        $HD = $request->request->get('heurDebut');
        
        $HeurD = new DateTime($HD);
        $seance->setHeurDebut($HeurD);
        $HF = $request->request->get('heurFin');
        $HeurF = new DateTime($HF);
        $seance->setHeurFin($HeurF);
        $calendrie = $this->getDoctrine()->getRepository('AppointmentsBundle:Calendries')->find($request->request->get('calendrier'));
        $seance->setCalendrie($calendrie);
        $seance->setDispo(1);
        $seance->setAbsence(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($seance);
        $em->flush();
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('AppointmentsBundle:Seances')->getSeacesByCalendar($request->request->get('calendrier'));
        return $this->render('seances/listOfSeances.html.twig', array(
            'seances' => $seances,
            'calendrie' => $calendrie,
        ));
    }
    public function changeAction($id){
        $em = $this->getDoctrine()->getManager();
        $seance = $em->getRepository('AppointmentsBundle:Seances')->find($id);
        if ($seance->getAbsence() == 1){
            $seance->setAbsence(0);
        }else{
            $seance->setAbsence(1);
        }
        $em->flush();
        return $this->redirectToRoute('seances_index',array('calendrie'=>$seance->getCalendrie()->getId()));
    }
}
