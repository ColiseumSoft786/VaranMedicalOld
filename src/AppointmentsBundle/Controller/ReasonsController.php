<?php

namespace AppointmentsBundle\Controller;

use AppointmentsBundle\Entity\Reasons;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reason controller.
 *
 */
class ReasonsController extends Controller
{
    public function getComboReasonsAction(){
        $em = $this->getDoctrine()->getManager();

        $reasons = $em->getRepository('AppointmentsBundle:Reasons')->findAll();

        return $this->render('reasons/comboReasons.html.twig', array(
            'reasons' => $reasons,
        ));
    }

    /**
     * Lists all reason entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reasons = $em->getRepository('AppointmentsBundle:Reasons')->findAll();

        return $this->render('reasons/index.html.twig', array(
            'reasons' => $reasons,
        ));
    }

    /**
     * Creates a new reason entity.
     *
     */
    public function newAction(Request $request)
    {
        $reason = new Reason();
        $form = $this->createForm('AppointmentsBundle\Form\ReasonsType', $reason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reason);
            $em->flush();

            return $this->redirectToRoute('reasons_show', array('id' => $reason->getId()));
        }

        return $this->render('reasons/new.html.twig', array(
            'reason' => $reason,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reason entity.
     *
     */
    public function showAction(Reasons $reason)
    {
        $deleteForm = $this->createDeleteForm($reason);

        return $this->render('reasons/show.html.twig', array(
            'reason' => $reason,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reason entity.
     *
     */
    public function editAction(Request $request, Reasons $reason)
    {
        $deleteForm = $this->createDeleteForm($reason);
        $editForm = $this->createForm('AppointmentsBundle\Form\ReasonsType', $reason);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reasons_edit', array('id' => $reason->getId()));
        }

        return $this->render('reasons/edit.html.twig', array(
            'reason' => $reason,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reason entity.
     *
     */
    public function deleteAction(Request $request, Reasons $reason)
    {
        $form = $this->createDeleteForm($reason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reason);
            $em->flush();
        }

        return $this->redirectToRoute('reasons_index');
    }

    /**
     * Creates a form to delete a reason entity.
     *
     * @param Reasons $reason The reason entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reasons $reason)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reasons_delete', array('id' => $reason->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
