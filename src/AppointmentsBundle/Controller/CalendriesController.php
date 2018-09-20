<?php

namespace AppointmentsBundle\Controller;

use AppointmentsBundle\Entity\Calendries;
use DataBundle\Entity;
use DoctorsBundle\Entity\Horaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Calendry controller.
 *
 */
class CalendriesController extends Controller
{
    /**
     * Lists all calendry entities.
     *
     */
    public function indexAction($id)
    {






        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($idDoctor);
        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($id);
        $locations = $em->getRepository('DoctorsBundle:Locations')->findBy(array('doctor' => $idDoctor, 'deleatedAt' => null, 'verified' => 1));

        return $this->render('calendries/index.html.twig', array(
            'doctor' => $doctor,
            'calendrie' => $calendrie,
            'locations' => $locations
        ));
    }

    /**
     * Creates a new calendry entity.
     *
     */
    public function newAction(Request $request)
    {
        $calendrie = new Calendries();
        $form = $this->createForm('AppointmentsBundle\Form\CalendriesType', $calendrie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $test = $this->getDoctrine()->getRepository('AppointmentsBundle:Calendries')->findBy(array('location' => $calendrie->getLocation(), 'date' => $calendrie->getDate(), 'deleatedAt' => null));
            if($test != null){
                return new Response('deja');
            }else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($calendrie);
                $em->flush();

                return new  Response('success');
            }
        }

        return $this->render('calendries/new.html.twig', array(
            'calendry' => $calendrie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a calendry entity.
     *
     */
    public function showAction(Calendries $calendry)
    {
        $deleteForm = $this->createDeleteForm($calendry);

        return $this->render('calendries/show.html.twig', array(
            'calendry' => $calendry,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing calendry entity.
     *
     */
    public function editAction(Request $request, Calendries $calendry)
    {
        $deleteForm = $this->createDeleteForm($calendry);
        $editForm = $this->createForm('AppointmentsBundle\Form\CalendriesType', $calendry);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calendries_edit', array('id' => $calendry->getId()));
        }

        return $this->render('calendries/edit.html.twig', array(
            'calendry' => $calendry,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function getCalendriesByLocationAction($location){
        $em = $this->getDoctrine()->getManager();
        if(!is_object($location)){
            if($location == 0){
                $user = $this->getUser();
                $idDoctor = $user->getIdTable();
                try{
                    $location = $em->getRepository('DoctorsBundle:Locations')->findBy(array('doctor' => $idDoctor, 'deleatedAt' => null, 'verified' => 1));
                }catch(Exception $e){
                    echo $e->getMessage();
                }
            }

        }
        $calendries = $em->getRepository('DataBundle:Calendries')->findBy(array('location' =>$location));

        $em = $this->getDoctrine();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);

        $pha = $em->getRepository('DataBundle:Publicholiday')->findAll();
        $temp = array();
        foreach($pha as $item){
            $chk = $this->getDoctrine()->getRepository('DataBundle:Unblockph')->findOneBy(array(
                'doctor' => $doctor,
                'ph' => $item
            ));
            if($chk == null){
                array_push($temp,$item);
            }
        }
        $pha = $temp;
        $bd = $em->getRepository('DataBundle:Blockdays')->findAll();
        $weekends = $this->getBlockDays($bd);
        $unbd = $this->getDoctrine()->getRepository('DataBundle:Unblockday')->findBy(array(
            'doctor' => $doctor
        ));
        foreach ($unbd as $item){
            $sd = explode("-",$item->getDate());
            $date = new \DateTime();
            $date->setDate($sd[0],$sd[1],$sd[2]);
            for ($i = 0; $i < count($weekends);$i++){
                if($weekends[$i]->format('d-m-Y') == $date->format('d-m-Y')){
                    array_splice($weekends,$i,1);
                    break;
                }
            }
        }
        return $this->render('calendries/listeCalendries.html.twig', array(
            'calendries' => $calendries,
            'pha' => $pha,
            'weekends' => $weekends
        ));
    }
    function getBlockDays($bd){
        $weekends = array();
        foreach($bd as $item){
            for ($i = 1;$i<=12;$i++){
                $month = $this->getAllDaysInAMonth(date("Y"),$i,$item->getDay());
                foreach($month as $inner){
                    array_push($weekends,$inner);
                }
            }
        }
        $final  = array();
        foreach ($weekends as $current) {
            if ( ! in_array($current, $final)) {
                $final[] = $current;
            }
        }
        return $final;
    }
    function getAllDaysInAMonth($year, $month, $day, $daysError = 3) {
        $dateString = 'first '.$day.' of '.$year.'-'.$month;

        if (!strtotime($dateString)) {
            throw new \Exception('"'.$dateString.'" is not a valid strtotime');
        }

        $startDay = new \DateTime($dateString);

        if ($startDay->format('j') > $daysError) {
            $startDay->modify('- 7 days');
        }

        $days = array();

        while ($startDay->format('Y-m') <= $year.'-'.str_pad($month, 2, 0, STR_PAD_LEFT)) {
            $days[] = clone($startDay);
            $startDay->modify('+ 7 days');
        }

        return $days;
    }


    public function getCalendriesByLocationByDateAction($location, $date){
        $em = $this->getDoctrine()->getManager();

        $calendries = $em->getRepository('AppointmentsBundle:Calendries')->getCalendrieByLocationByDate($location, $date);
        return $this->render('calendries/listeCalendries.html.twig', array(
            'calendries' => $calendries,
        ));
    }

    /**
     * Deletes a calendry entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $delete = $em->getRepository('AppointmentsBundle:Calendries')->delete($id);
        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($id);

        if($delete){
            return $this->redirectToRoute('calendries_index', array('id' => $id));
        }else{
            return new Response('erreur');
        }
    }

    /**
     * Creates a form to delete a calendry entity.
     *
     * @param Calendries $calendry The calendry entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Calendries $calendry)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calendries_delete', array('id' => $calendry->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function activationAction($id, $active)
    {
        $em = $this->getDoctrine()->getManager();
        $activation = $em->getRepository('AppointmentsBundle:Calendries')->activation($id, $active);
        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($id);

        if($activation){
            $location = $calendrie->getLocation();
            $calendries = $em->getRepository('AppointmentsBundle:Calendries')->findBy(array('location' => $location, 'deleatedAt' => null));
            return $this->render('calendries/listeCalendries.html.twig', array(
                'calendries' => $calendries,
            ));
        }else{
            return new Response('erreur');
        }
    }

    public function absenceAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($id);
        if ($calendrie->getAbsence() == 1){
            $em->getRepository('AppointmentsBundle:Calendries')->absence($id, 0);
            return $this->redirectToRoute('calendries_index', array('id' => $id));
        }else{
            $em->getRepository('AppointmentsBundle:Calendries')->absence($id, 1);
            return $this->redirectToRoute('calendries_index', array('id' => $id));
        }
    }
    public function createabsenceAction(Request $request){
        if($request->getMethod()== "POST"){
            $num = $request->get('day');
            $id = $request->get('loc');
            $loc = $this->getDoctrine()->getRepository('DataBundle:Locations')->find($id);
            $exdate = explode("-",$request->get('date'));
            $date = $request->get('date');
            for ($i = 0;$i<$num;$i++){
                $newformat = date('Y-m-d',strtotime($date));
                $new = new \DateTime($newformat);
                $calcheck = $this->getDoctrine()->getRepository('DataBundle:Calendries')->findOneBy(
                    array('location'=>$loc,'date' => $new)
                );
                if($calcheck != null){
                    $em = $this->getDoctrine()->getManager();
                    $ucal = $em->getRepository('DataBundle:Calendries')->find($calcheck->getId());
                    $ucal->setAbsence(1);
                    $em->flush();
                }else{
                    $cal = new Entity\Calendries();
                    $cal->setDeleatedat(null);
                    $cal->setAbsence(1);
                    $cal->setDate($new);
                    $cal->setLocation($loc);
                    $cal->setPublic(1);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($cal);
                    $em->flush();
                }

                $exdate[2] = $exdate[2] + 1;
                if($exdate[2] < 10){
                    $exdate[2] = "0".$exdate[2];
                }
                $date = $exdate[0] ."-". $exdate[1] ."-". $exdate[2];
            }
            return $this->redirectToRoute('calendries_index', array('id' => 0));


        }
    }
    public function createappAction(Request $request){


        $sd = explode("-",$request->get('sdate'));
        $sdate = new \DateTime();
        $sdate->setDate($sd[0],$sd[1],$sd[2]);
        $ed = explode("-",$request->get('edate'));
        $edate = new \DateTime();
        $edate->setDate($ed[0],$ed[1],$ed[2]);
        $stime = new \DateTime();
        $t = explode(":",$request->get('stime'));
        $stime->setTime($t[0], $t[1], "00");
        $etime = new \DateTime();
        $t = explode(":",$request->get('etime'));
        $etime->setTime($t[0], $t[1], "00");

        $loc = $request->get('loc');
        $atime = $request->get('atime');
        $ptime = $request->get('ptime');
        $break = $request->get('break');
        if ($break == "on"){
            $sbtime = new \DateTime();
            $t = explode(":",$request->get('sbtime'));
            $sbtime->setTime($t[0], $t[1], "00");
            $ebtime = new \DateTime();
            $t = explode(":",$request->get('ebtime'));
            $ebtime->setTime($t[0], $t[1], "00");
        }

        $em = $this->getDoctrine();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DataBundle:Doctors')->find($idDoctor);
        $unb = $this->getDoctrine()->getRepository('DataBundle:Unblockph')->findBy(array(
            'doctor'=> $doctor
        ));
        $hd = $this->getDoctrine()->getRepository('DataBundle:Publicholiday')->findAll();
        $temp =  array();
        if(count($unb) > 0){
            foreach($unb as $item){
                foreach($hd as $inner){
                    if($inner != $item->getPh()){
                        array_push($temp,$inner);
                    }
                }
            }
            $hd = $temp;
        }

        $location = $this->getDoctrine()->getRepository('DataBundle:Locations')->find($loc);
        $bd = $this->getDoctrine()->getRepository('DataBundle:Blockdays')->findAll();
        $weekends = $this->getBlockDays($bd);
        $unbd = $this->getDoctrine()->getRepository('DataBundle:Unblockday')->findBy(array(
            'doctor' => $doctor
        ));
        foreach ($unbd as $item){
            $sd = explode("-",$item->getDate());
            $date = new \DateTime();
            $date->setDate($sd[0],$sd[1],$sd[2]);
            for ($j = 0; $j < count($weekends);$j++){
                if($weekends[$j]->format('d-m-Y') == $date->format('d-m-Y')){
                    array_splice($weekends,$j,1);
                    break;
                }
            }
        }
        for ($i = clone $sdate;$i <= $edate;$i->modify("+1 day")){

            $found = false;
            foreach ($weekends as $item){
                if($item->format('Y-m-d') == $i->format('Y-m-d')){
                    $found = true;
                }
            }

            foreach($hd as $item){
                if($item->getDate() == $i->format('m/d/Y')){
                    $found = true;
                }
            }

            //getharare from location
            // get day from $i in french
            // find day from hrare :: you will get start time and end time.


            $fday = $this->getDayInFrench($i);
//            echo $fday;
            $time = $this->getDoctrine()->getRepository(Horaire::class)->findOneBy(array(
                'jour'=>$fday, 'locationId'=>$loc
            ));
//            echo count($time);
            echo '<br>';
            /*foreach ($time as $item) {*/
                $startDaytime = clone $time->getHeureDebut();
                $endDaytime = clone $time->getHeureFin();
                $startSelectedtime = clone $stime;
                $endSelectedtime = clone $etime;
            echo $startDaytime->format('His') ."<br>";
            echo $endDaytime->format('His')  ."<br>";
            echo $startSelectedtime->format('His')  ."<br>";
            echo $endSelectedtime->format('His') ."<br>--------<br>" ;
                //echo $startDaytime;
//            echo $startDaytime->getTimestamp();
//            echo $startDaytime->format('Hisms');
                if($startDaytime->format('His') != 000000)
                {
                     $selectedtimestart = "";
                    $selectedtimeend = "";
                    $check11  = false;
                    if ($startDaytime->format('His') >= $startSelectedtime->format('His')){
                        $selectedtimestart = clone $startDaytime;
                    }else{
                        $selectedtimestart = clone $startSelectedtime;
                    }
//                    echo $selectedtimestart . "-";
                    if ($endDaytime->format('His') <= $endSelectedtime->format('His')){
                        $selectedtimeend = clone $endDaytime;
                    }else{
                        $selectedtimeend = clone $endSelectedtime;
                    }
//                    echo $selectedtimeend;
                    if ($startDaytime->format('His') <= $selectedtimestart->format('His') && $endDaytime->format('His') >= $selectedtimeend->format('His')){
                        echo $selectedtimestart->format('H:i');
                        echo 'Start';
                        echo '<br>';
                        echo $selectedtimeend->format('H:i');
                        echo 'End';
                        echo '<br>';
                    }else{
                        $found = true;
                        echo "Not running ". $fday;
                    }

                    /*if($startSelectedtime >= $startDaytime && $endSelectedtime <= $endDaytime)
                    {
                        echo "running ". $fday;
                        echo $startSelectedtime;
                        echo 'Start';
                        echo '<br>';
                        echo $endSelectedtime;
                        echo 'End';
                        echo '<br>';
                    }
                    else
                    {
                        if($startSelectedtime < $startDaytime)
                        {
                            echo $startDaytime;
                        }


                        echo "Not running ". $fday;
                        $found = true;
                        echo '<script>alert("Alloted time range is out of specified range")</script>';
                    }*/
                }
                else
                {
                    echo "Not running ". $fday;
                    $found = true;
                    echo '<script>alert("Time alloted to current day is 00:00. Please check your work place (Lieux De Travail)")</script>';
                }


//            }





            if(!$found){
                // if (stime < stimeofhrare) replace stime = clone stimeofharare;
                // if (etime > etimeofhrar) re






                $emcheck = $this->getDoctrine()->getManager();
                $calcheck = $emcheck->getRepository('DataBundle:Calendries')->findOneBy(array('date' => $i,'location'=>$location, 'deleatedat' => null));
                if($calcheck != null){
                    $calcheck->setDeleatedAt(new \DateTime());
//                    $emcheck->flush();
                }
                // if($calcheck == null){

                $em = $this->getDoctrine()->getManager();
                $calendrie = new Entity\Calendries();
                $calendrie->setDate($i);
                $calendrie->setLocation($location);
                $calendrie->setPublic(1);
                $calendrie->setAbsence(0);
                $em->persist($calendrie);
//                $em->flush();
                if($break == "on"){
                    $ebbtime = clone $sbtime;
                    $tempStime = clone $stime;
                    for ($total = 0;$total <2;$total++){
                        $check = true;
                        while($check){
                            $SApp = clone $tempStime;
                            $EApp = clone $tempStime->modify("+".$atime." minutes");
                            if ($EApp <= $ebbtime){
                                echo "<h2>".$SApp->format('H:i')."-".$EApp->format('H:i')."</h2>";
                                $em1 = $this->getDoctrine()->getManager();
                                $seance = new Entity\Seances();
                                $seance->setHeurDebut($SApp);
                                $seance->setHeurFin($EApp);
                                $seance->setAbsence(0);
                                $seance->setCalendrie($calendrie);
                                $seance->setDispo(1);
                                $em1->persist($seance);
//                                $em1->flush();
                                $tempStime->modify("+".$ptime." minutes");
                            }else{
                                $check = false;
                            }
                        }
                        $ebbtime = clone $etime;
                        $tempStime = clone $ebtime;
                    }


                }
                else{
                    $tempStime = clone $stime;
                    $check = true;
                    while($check){
                        $SApp = clone $tempStime;
                        $EApp = clone $tempStime->modify("+".$atime." minutes");
                        if ($EApp <= $etime){
//                            echo "<h2>".$SApp->format('H:i')."-".$EApp->format('H:i')."</h2>";
                            $em1 = $this->getDoctrine()->getManager();
                            $seance = new Entity\Seances();
                            $seance->setHeurDebut($SApp);
                            $seance->setHeurFin($EApp);
                            $seance->setAbsence(0);
                            $seance->setCalendrie($calendrie);
                            $seance->setDispo(1);
                            $em1->persist($seance);
//                            $em1->flush();
                            $tempStime->modify("+".$ptime." minutes");
                        }else{
                            $check = false;
                        }
                    }
                }
                //  }
            }
            // $i->date;



        }

        return new Response("OK");
        /*
        return $this->redirect($this->generateUrl('calendries_index',array('id' => 0)));
          */

    }
    public function getDayInFrench($date)
    {
        $day =  $date->format('D');
        $usdayArray = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'];
        $frenchDayArray = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
        $index = array_search($day,$usdayArray);
        return $frenchDayArray[$index];
//
    }
    public function copyadayAction($calendrie,Request $request){
        $caltocopy = $this->getDoctrine()->getRepository('DataBundle:Calendries')->find($calendrie);
        $seanstocopy = $this->getDoctrine()->getRepository('DataBundle:Seances')->findBy(array(
            'calendrie' => $caltocopy
        ));
        $calcopied = "";
        $sd = explode("-",$request->get('date'));
        $date = new \DateTime();
        $date->setDate($sd[0],$sd[1],$sd[2]);
        $calcheck = $this->getDoctrine()->getRepository('DataBundle:Calendries')->findOneBy(array('date' => $date, 'deleatedat' => null));
        if($calcheck != null){
            $em = $this->getDoctrine()->getManager();
            $c = $em->getRepository('DataBundle:Calendries')->find($calcheck->getId());
            $c->setDeleatedAt(new \DateTime());
            $em->flush();
        }
        $calcopied = new Entity\Calendries();
        $calcopied->setAbsence(0);
        $calcopied->setPublic(1);
        $calcopied->setDate($date);
        $calcopied->setLocation($caltocopy->getLocation());
        $em = $this->getDoctrine()->getManager();
        $em->persist($calcopied);
        $em->flush();
        foreach ($seanstocopy as $item){
            $seance = new Entity\Seances();
            $seance->setAbsence(0);
            $seance->setDispo(1);
            $seance->setCalendrie($calcopied);
            $seance->setHeurFin($item->getHeurFin());
            $seance->setHeurDebut($item->getHeurDebut());
            $em = $this->getDoctrine()->getManager();
            $em->persist($seance);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('seances_index',array('calendrie' => $calcopied->getId())));


        //return $this->redirect($this->generateUrl('seances_index',array('calendrie' => $calendrie)));
    }

    public function checkCalendrieAction(Request $request){
        $sd = explode("-",$request->get('date'));
        $date = new \DateTime();
        $date->setDate($sd[0],$sd[1],$sd[2]);
        $calcheck = $this->getDoctrine()->getRepository('DataBundle:Calendries')->findOneBy(array('date' => $date, 'deleatedat' => null));
        if($calcheck == null){
            return new Response('true');
        }else{
            if($calcheck->getDeleatedAt() == null){
                $sea = $this->getDoctrine()->getRepository('DataBundle:Seances')->findBy(array(
                    'calendrie' => $calcheck->getId()
                ));
                if(count($sea) == 0){
                    return new Response('true');
                }else{
                    return new Response('false');
                }
            }else{
                return new Response('true');
            }
        }
    }

    public function publierAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calendrie = $em->getRepository('AppointmentsBundle:Calendries')->find($id);
        if ($calendrie->getPublic() == 1){
            $em->getRepository('AppointmentsBundle:Calendries')->publier($id, 0);
            return $this->redirectToRoute('calendries_index', array('id' => $id));
        }else{
            $em->getRepository('AppointmentsBundle:Calendries')->publier($id, 1);
            return $this->redirectToRoute('calendries_index', array('id' => $id));
        }
    }
}
