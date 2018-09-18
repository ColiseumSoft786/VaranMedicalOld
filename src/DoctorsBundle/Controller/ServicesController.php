<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Service controller.
 *
 */
class ServicesController extends Controller
{
    public function comboServicesByDoctorAction($doctor){
        $em = $this->getDoctrine()->getManager();

        $services = $em->getRepository('DoctorsBundle:Services')->getServicesByDoctor($doctor);
        return $this->render('services/comboServicesByDoctor.html.twig', array(
            'services' => $services,
            'doctor' => $doctor
        ));
    }

    public function comboServicesBySpecialitieAction($specialitie)
    {
        $em = $this->getDoctrine()->getManager();

        $specialitie_object = $em->getRepository('DoctorsBundle:Specialities')->findBy(array('libelle'=>$specialitie));
        $services = $em->getRepository('DoctorsBundle:Services')->findBy(array('specialitie' => $specialitie_object));
        return $this->render('services/comboServices.html.twig', array(
            'services' => $services,
        ));
    }
    public function listServicesByDoctorAction($doctor)
    {
        $em = $this->getDoctrine()->getManager();

        $services = $em->getRepository('DoctorsBundle:Services')->getServicesByDoctor($doctor);

        return $this->render('services/listeServicesDoctorDetails.html.twig', array(
            'services' => $services,
            'doctor' => $doctor
        ));
    }

    /**
     * Lists all service entities.
     *
     */
    public function indexAction($doctor)
    {
        $em = $this->getDoctrine()->getManager();

        $services = $em->getRepository('DoctorsBundle:Services')->getServicesByDoctor($doctor);

        return $this->render('services/index.html.twig', array(
            'services' => $services,
            'doctor' => $doctor
        ));
    }

    /**
     * Creates a new service entity.
     *
     */
    public function newAction(Request $request)
    {
        $service = new Services();
        $form = $this->createForm('DoctorsBundle\Form\ServicesType', $service);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($user->getIdTable());
  
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('services_show', array('id' => $service->getId()));
        }

        return $this->render('services/new.html.twig', array(
            'service' => $service,
            'form' => $form->createView(),
            'doctor' => $doctor,
        ));
    }

    public function settingsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($user->getIdTable());
        return $this->render('services/settings.html.twig', array(
            'user' => $user,
            'doctor' => $doctor
        ));
    }

    /**
     * Finds and displays a service entity.
     *
     */
    public function showAction(Services $service)
    {
        $deleteForm = $this->createDeleteForm($service);

        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($user->getIdTable());
        
        
        return $this->render('services/show.html.twig', array(
            'service' => $service,
            'delete_form' => $deleteForm->createView(),
            'doctor' => $doctor,
        ));
    }

    /**
     * Displays a form to edit an existing service entity.
     *
     */
    public function editAction(Request $request, Services $service)
    {
        $deleteForm = $this->createDeleteForm($service);
        $editForm = $this->createForm('DoctorsBundle\Form\ServicesType', $service);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($user->getIdTable());
        
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('services_edit', array('id' => $service->getId()));
        }

        return $this->render('services/edit.html.twig', array(
            'service' => $service,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'doctor' => $doctor,
        ));
    }

    /**
     * Deletes a service entity.
     *
     */
    public function deleteAction(Request $request, Services $service)
    {
        $form = $this->createDeleteForm($service);
        $form->handleRequest($request);

        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($user->getIdTable());
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();
        }

        return $this->redirectToRoute('services_index', array('doctor' => $doctor));
        

    }

    /**
     * Creates a form to delete a service entity.
     *
     * @param Services $service The service entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Services $service)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('services_delete', array('id' => $service->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
