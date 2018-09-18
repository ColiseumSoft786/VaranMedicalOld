<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\Specialities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Speciality controller.
 *
 */
class SpecialitiesController extends Controller
{


    public function getComboSpecialitiesAction(){
        $em = $this->getDoctrine()->getManager();

        $specialities = $em->getRepository('DoctorsBundle:Specialities')->findAll();

        return $this->render('specialities/profilEditcomboSpecialities.html.twig', array(
            'specialities' => $specialities,
        ));
    }
    public function getComboSpecialitiesByDoctorAction($doctor){
        $em = $this->getDoctrine()->getManager();

        $specialities = $em->getRepository('DoctorsBundle:Specialities')->getSpecialitiesByDoctor($doctor);
        return $this->render('specialities/comboSpecialitiers.html.twig', array(
            'specialities' => $specialities,
        ));
    }
    /**
     * Lists all speciality entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $specialities = $em->getRepository('DoctorsBundle:Specialities')->findAll();

        return $this->render('specialities/index.html.twig', array(
            'specialities' => $specialities,
        ));
    }

    /**
     * Creates a new speciality entity.
     *
     */
    public function newAction(Request $request)
    {
        $speciality = new Specialities();
        $form = $this->createForm('DoctorsBundle\Form\SpecialitiesType', $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($speciality);
            $em->flush();

            return $this->redirectToRoute('specialities_show', array('id' => $speciality->getId()));
        }

        return $this->render('specialities/new.html.twig', array(
            'speciality' => $speciality,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a speciality entity.
     *
     */
    public function showAction(Specialities $speciality)
    {
        $deleteForm = $this->createDeleteForm($speciality);

        return $this->render('specialities/show.html.twig', array(
            'speciality' => $speciality,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing speciality entity.
     *
     */
    public function editAction(Request $request, Specialities $speciality)
    {
        $deleteForm = $this->createDeleteForm($speciality);
        $editForm = $this->createForm('DoctorsBundle\Form\SpecialitiesType', $speciality);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specialities_edit', array('id' => $speciality->getId()));
        }

        return $this->render('specialities/edit.html.twig', array(
            'speciality' => $speciality,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a speciality entity.
     *
     */
    public function deleteAction(Request $request, Specialities $speciality)
    {
        $form = $this->createDeleteForm($speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($speciality);
            $em->flush();
        }

        return $this->redirectToRoute('specialities_index');
    }

    /**
     * Creates a form to delete a speciality entity.
     *
     * @param Specialities $speciality The speciality entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Specialities $speciality)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('specialities_delete', array('id' => $speciality->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
    // i added this function
    public function getSpecialitiesAction(){
        $em = $this->getDoctrine()->getManager();

        $specialities = $em->getRepository('DoctorsBundle:Specialities')->findAll();
        return $this->render('specialities/comboSpecialitiers.html.twig', array(
            'specialities' => $specialities,
        ));
    }
}
