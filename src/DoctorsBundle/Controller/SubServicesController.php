<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\SubServices;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subservice controller.
 *
 */
class SubServicesController extends Controller
{
    /**
     * Lists all subService entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subServices = $em->getRepository('DoctorsBundle:SubServices')->findAll();

        return $this->render('subservices/index.html.twig', array(
            'subServices' => $subServices,
        ));
    }

    /**
     * Creates a new subService entity.
     *
     */
    public function newAction(Request $request)
    {
        $subService = new Subservices();
        $form = $this->createForm('DoctorsBundle\Form\SubServicesType', $subService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subService);
            $em->flush();

            return $this->redirectToRoute('subservices_show', array('id' => $subService->getId()));
        }

        return $this->render('subservices/new.html.twig', array(
            'subService' => $subService,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subService entity.
     *
     */
    public function showAction(SubServices $subService)
    {
        $deleteForm = $this->createDeleteForm($subService);

        return $this->render('subservices/show.html.twig', array(
            'subService' => $subService,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subService entity.
     *
     */
    public function editAction(Request $request, SubServices $subService)
    {
        $deleteForm = $this->createDeleteForm($subService);
        $editForm = $this->createForm('DoctorsBundle\Form\SubServicesType', $subService);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subservices_edit', array('id' => $subService->getId()));
        }

        return $this->render('subservices/edit.html.twig', array(
            'subService' => $subService,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subService entity.
     *
     */
    public function deleteAction(Request $request, SubServices $subService)
    {
        $form = $this->createDeleteForm($subService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subService);
            $em->flush();
        }

        return $this->redirectToRoute('subservices_index');
    }

    /**
     * Creates a form to delete a subService entity.
     *
     * @param SubServices $subService The subService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SubServices $subService)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subservices_delete', array('id' => $subService->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function comboSubServicesByServiceAction($service)
    {
        $em = $this->getDoctrine()->getManager();
            
        $services_object = $em->getRepository('DoctorsBundle:Services')->find($service);
        $subServices = $em->getRepository('DoctorsBundle:SubServices')->findBy(array('service' => $services_object));
        
        return $this->render('subservices/comboSubServices.html.twig', array(
            'subServices' => $subServices,
        ));
    }
}
