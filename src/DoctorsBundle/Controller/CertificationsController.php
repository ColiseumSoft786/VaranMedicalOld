<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\Certifications;
use DoctorsBundle\Form\CertificationsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Certification controller.
 *
 */
class CertificationsController extends Controller
{

    public function addCertificationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $entity = new Certifications();
        $form = $this->createForm(CertificationsType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $certification = $em->getRepository('DoctorsBundle:Doctors')->find($request->get('idOwner'))->addCertification($entity);
            $entity->setDoctor($certification);
            $em->persist($entity);
            $em->flush();
        }
        $certifications = $em->getRepository('DoctorsBundle:Certifications')->findBy(array('doctor' => $request->get('idOwner')));
        return $this->render('doctors/profilEditCertifications.html.twig', array(
            'certifications' => $certifications,
        ));

    }

    public function getDoctorCertificationAction($doctor){
        $em = $this->getDoctrine()->getManager();

        $certifications = $em->getRepository('DoctorsBundle:Certifications')->findBy(array('doctor' => $doctor));

        return $this->render('certifications/listeOfCertifications.html.twig', array(
            'certifications' => $certifications,
        ));
    }
    /**
     * Lists all certification entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $certifications = $em->getRepository('DoctorsBundle:Certifications')->findAll();

        return $this->render('certifications/index.html.twig', array(
            'certifications' => $certifications,
        ));
    }

    /**
     * Creates a new certification entity.
     *
     */
    public function newAction(Request $request)
    {
        $certification = new Certifications();
        $form = $this->createForm('DoctorsBundle\Form\CertificationsType', $certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($certification);
            $em->flush();

            return $this->redirectToRoute('certifications_show', array('id' => $certification->getId()));
        }

        return $this->render('certifications/new.html.twig', array(
            'certification' => $certification,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a certification entity.
     *
     */
    public function showAction(Certifications $certification)
    {
        $deleteForm = $this->createDeleteForm($certification);

        return $this->render('certifications/show.html.twig', array(
            'certification' => $certification,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing certification entity.
     *
     */
    public function editAction(Request $request, Certifications $certification)
    {
        $deleteForm = $this->createDeleteForm($certification);
        $editForm = $this->createForm('DoctorsBundle\Form\CertificationsType', $certification);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $user = $this->getUser();
            $idDoctor = $user->getIdTable();
            $certifications = $this->getDoctrine()->getRepository('DoctorsBundle:Certifications')->findBy(array('doctor' => $idDoctor));

            return $this->render('certifications/listeOfCertifications.html.twig', array(
                'certifications' => $certifications,
                'message' => 'success'

            ));
        }

        return $this->render('certifications/edit.html.twig', array(
            'certification' => $certification,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'message' => 'erreur'
        ));
    }

    /**
     * Deletes a certification entity.
     *
     */
    public function deleteAction(Request $request, $certification)
    {

        $request = $this->container->get('request_stack')->getCurrentRequest();
        $user = $this->getUser();
        $doctorId = $user->getIdTable();
        if ($request->isXmlHttpRequest()) {

            $doctor = $this->getDoctrine()->getRepository('DoctorsBundle:Doctors')->find($doctorId);
            $certification = $this->getDoctrine()->getRepository('DoctorsBundle:Certifications')->find($certification);
            $em = $this->getDoctrine()->getManager();
            $em->remove($certification);
            $em->flush();

            $certifications = $em->getRepository('DoctorsBundle:Certifications')->findBy(array('doctor' => $doctor));

            return $this->render('doctors/profilEditCertifications.html.twig', array(
                'certifications' => $certifications,
            ));
        }
    }

    /**
     * Creates a form to delete a certification entity.
     *
     * @param Certifications $certification The certification entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Certifications $certification)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('certifications_delete', array('certification' => $certification->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
