<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\Invoices;
use DoctorsBundle\Entity\Doctors;
use DoctorsBundle\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Invoice controller.
 *
 */
class InvoicesController extends Controller
{

    public function listeOfInvoicesByDoctorAction($doctor, $service)
    {
        $em = $this->getDoctrine()->getManager();

        $invoices = $em->getRepository('DoctorsBundle:Invoices')->getSubServicesByDoctor($doctor, $service);

        return $this->render('invoices/listeInvoicesDoctorDetails.html.twig', array(
            'invoices' => $invoices,
        ));
    }

    /**
     * Lists all invoice entities.
     *
     */
    public function indexAction($doctor, $service)
    {
        $em = $this->getDoctrine()->getManager();

        $invoices = $em->getRepository('DoctorsBundle:Invoices')->getSubServicesByDoctor($doctor, $service);

        return $this->render('invoices/index.html.twig', array(
            'invoices' => $invoices,
        ));
    }

    public function listSubServicesByDoctorAction($doctor, $service)
    {
        $em = $this->getDoctrine()->getManager();

        $subServices = $em->getRepository('DoctorsBundle:Invoices')->getSubServicesByDoctor($doctor, $service);

        return $this->render('subservices/listSubServiceByDoctor.html.twig', array(
            'subServices' => $subServices,
        ));
    }

    /**
     * Creates a new invoice entity.
     *
     */
    public function newAction(Request $request)
    {
        $invoice = new Invoices();
        $form = $this->createForm('DoctorsBundle\Form\InvoicesType', $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $test = $this->getDoctrine()->getRepository('DoctorsBundle:Invoices')->findBy(array('doctor' => $invoice->getDoctor(), 'subService' => $invoice->getSubService()));
            if($test != null){
                return new Response('deja');
            }else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoice);
                $em->flush();
                return new Response('Success');
            }
        }
        return $this->render('invoices/new.html.twig', array(
            'invoice' => $invoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invoice entity.
     *
     */
    public function showAction(Invoices $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);

        return $this->render('invoices/show.html.twig', array(
            'invoice' => $invoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invoice entity.
     *
     */
    public function editAction(Request $request, Invoices $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);
        $editForm = $this->createForm('DoctorsBundle\Form\InvoicesType', $invoice);
        $editForm->handleRequest($request);

        
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($user->getIdTable());

        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find(50);
        $services = $em->getRepository('DoctorsBundle:Services')->getServicesByDoctor($doctor);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invoices_edit', array('id' => $invoice->getId()));
        }
        
        
        return $this->render('invoices/edit.html.twig', array(
            'invoice' => $invoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'doctor' => $doctor,
        ));
    }

    /**
     * Deletes a invoice entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        if ($request->isXmlHttpRequest()) {
            $invoice = $this->getDoctrine()->getRepository('DoctorsBundle:Invoices')->find($id);
            $subService = $invoice->getSubService();
            $subServices = $this->getDoctrine()->getRepository('DoctorsBundle:SubServices')->find($subService);
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();

            return new Response('delete');
        }
    }

    /**
     * Creates a form to delete a invoice entity.
     *
     * @param Invoices $invoice The invoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Invoices $invoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoices_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
