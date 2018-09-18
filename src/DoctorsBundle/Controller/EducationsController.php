<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\Educations;
use DoctorsBundle\Form\EducationsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Education controller.
 *
 */
class EducationsController extends Controller
{
    public function addEducationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $entity = new Educations();
        $form = $this->createForm(EducationsType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $education = $em->getRepository('DoctorsBundle:Doctors')->find($request->get('idOwner'))->addEducation($entity);
            $entity->setDoctor($education);
            $em->persist($entity);
            $em->flush();
        }
        $educations = $em->getRepository('DoctorsBundle:Educations')->findBy(array('doctor' => $request->get('idOwner')));
        return $this->render('doctors/profilEditEducations.html.twig', array(
            'educations' => $educations,
        ));

    }

    public function getDoctorEducationAction($doctor){
        $em = $this->getDoctrine()->getManager();

        $educations = $em->getRepository('DoctorsBundle:Educations')->findBy(array('doctor' => $doctor));

        return $this->render('educations/listeOfEducations.html.twig', array(
            'educations' => $educations,
        ));
    }
    /**
     * Lists all education entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $educations = $em->getRepository('DoctorsBundle:Educations')->findAll();

        return $this->render('educations/index.html.twig', array(
            'educations' => $educations,
        ));
    }

    /**
     * Creates a new education entity.
     *
     */
    public function newAction(Request $request)
    {
        $education = new Educations();
        $form = $this->createForm('DoctorsBundle\Form\EducationsType', $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($education);
            $em->flush();

            return $this->redirectToRoute('educations_show', array('id' => $education->getId()));
        }

        return $this->render('educations/new.html.twig', array(
            'education' => $education,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a education entity.
     *
     */
    public function showAction(Educations $education)
    {
        $deleteForm = $this->createDeleteForm($education);

        return $this->render('educations/show.html.twig', array(
            'education' => $education,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing education entity.
     *
     */
    public function editAction(Request $request, Educations $education)
    {
        $deleteForm = $this->createDeleteForm($education);
        $editForm = $this->createForm('DoctorsBundle\Form\EducationsType', $education);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $user = $this->getUser();
            $idDoctor = $user->getIdTable();
            $educations = $this->getDoctrine()->getRepository('DoctorsBundle:Educations')->findBy(array('doctor' => $idDoctor));

            return $this->render('educations/listeOfEducations.html.twig', array(
                'educations' => $educations,
                'message' => 'success'

            ));
        }

        return $this->render('educations/edit.html.twig', array(
            'education' => $education,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'message' => 'erreur'
        ));
    }

    /**
     * Deletes a education entity.
     *
     */
    public function deleteAction(Request $request, $education)
    {

        $request = $this->container->get('request_stack')->getCurrentRequest();
        $user = $this->getUser();
        $doctorId = $user->getIdTable();
        if ($request->isXmlHttpRequest()) {

            $doctor = $this->getDoctrine()->getRepository('DoctorsBundle:Doctors')->find($doctorId);
            $education = $this->getDoctrine()->getRepository('DoctorsBundle:Educations')->find($education);
            $em = $this->getDoctrine()->getManager();
            $em->remove($education);
            $em->flush();

            $educations = $em->getRepository('DoctorsBundle:Educations')->findBy(array('doctor' => $doctor));

            return $this->render('educations/listeOfEducations.html.twig', array(
                'educations' => $educations,
            ));
        }
    }

    /**
     * Creates a form to delete a education entity.
     *
     * @param Educations $education The education entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Educations $education)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('educations_delete', array('education' => $education->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
