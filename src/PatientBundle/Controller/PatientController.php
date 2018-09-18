<?php

namespace PatientBundle\Controller;

use DataBundle\Entity\FosUser;
use DataBundle\Entity\Notification;
use PatientBundle\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
/**
 * Patient controller.
 *
 */
class PatientController extends Controller
{
    /**
     * Lists all patient entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $patients = $em->getRepository('PatientBundle:Patient')->findAll();

        return $this->render('patient/index.html.twig', array(
            'patients' => $patients,
        ));
    }

    /**
     * Creates a new patient entity.
     *
     */
    public function newAction(Request $request)
    {
        $patient = new Patient();
        $form = $this->createForm('PatientBundle\Form\PatientType', $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();

            return $this->redirectToRoute('patient_show', array('id' => $patient->getId()));
        }

        return $this->render('patient/new.html.twig', array(
            'patient' => $patient,
            'form' => $form->createView(),
        ));
    }

    public function profilAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserBundle:User')->find($id);
        $patient = $em->getRepository('PatientBundle:Patient')->find($user->getIdTable());
        $notif = $em->getRepository(Notification::class)->findOneBy(array('user'=>$id));

        return $this->render('patient/profil.html.twig', array(
            'user' => $user,
            'patient' => $patient,
            'notif' => $notif
        ));
    }

    /**
     * Finds and displays a patient entity.
     *
     */
    public function showAction(Patient $patient)
    {
        $deleteForm = $this->createDeleteForm($patient);

        return $this->render('patient/show.html.twig', array(
            'patient' => $patient,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function togglenotifAction(Request $request){
        $toggle = $request->get('toggle');
        $val = $request->get('val');
        $user = $this->getDoctrine()->getRepository(FosUser::class)->find($request->get('id'));
        $userid = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository(Notification::class)->findOneBy(array('user'=>$userid));
        if ($notif == null){
            $notific = new Notification();
            $notific->setUser($userid);
            if ($toggle == 'email'){
                $notific->setEmail(0);
                $notific->setSms(1);
                ;           }else if($toggle == 'sms'){
                $notific->setEmail(1);
                $notific->setSms(0);
            }
            $em->persist($notific);
        }else{

            if ($toggle == 'email'){
                $notif->setEmail($val);
            }if($toggle == 'sms'){
                $notif->setSms($val);
            }

        }
        $em->flush();
        return $this->redirectToRoute('patient_profil',array('id' => $userid));
    }
    public function verifierNomAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        if ($request->isXmlHttpRequest()) {
            $nom = $request->request->get('nom');
            $test = $this->getDoctrine()->getRepository('PatientBundle:Patient')->findBy(array('lastName' => $nom));
            if ($test == null){
                return new Response('dispo');
            }else{
                return new Response('noDispo');
            }
        }
    }

    public function verifierPrenomAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        if ($request->isXmlHttpRequest()) {
            $nom = $request->request->get('prenom');
            $test = $this->getDoctrine()->getRepository('PatientBundle:Patient')->findBy(array('firstName' => $nom));
            if ($test == null){
                return new Response('dispo');
            }else{
                return new Response('noDispo');
            }
        }
    }

    /**
     * Displays a form to edit an existing patient entity.
     *
     */
    public function editAction(Request $request, Patient $patient)
    {
        $deleteForm = $this->createDeleteForm($patient);
        $editForm = $this->createForm('PatientBundle\Form\PatientType', $patient);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('UserBundle:User')->findBy(array('idTable' => $patient->getId()));
            foreach ($user as $use);
            return $this->redirectToRoute('patient_profil', array('id' => $use->getId()));
        }

        return $this->render('patient/edit.html.twig', array(
            'patient' => $patient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a patient entity.
     *
     */
    public function deleteAction(Request $request, Patient $patient)
    {
        $form = $this->createDeleteForm($patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($patient);
            $em->flush();
        }

        return $this->redirectToRoute('patient_index');
    }

    /**
     * Creates a form to delete a patient entity.
     *
     * @param Patient $patient The patient entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Patient $patient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('patient_delete', array('id' => $patient->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function createAction(Request $request)
    {
        $entity = new Patient();
        $form = $this->createForm('PatientBundle\Form\PatientType', $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $idPatient = $entity->getId();
            $user = new User();
            $form = $this->createForm('UserBundle\Form\UserType', $user);
            $form->handleRequest($request);

            return $this->render('user/new.html.twig', array(
                'idDoctor' => $idPatient,
                'utilisateur' => $user,
                'table' => 'patients',
                'form' => $form->createView(),
            ));
        }else{
            return new Response('erreur');
        }
    }
}
