<?php

namespace AppBundle\Controller;

use AppBundle\Entity\hopitaux;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Hopitaux controller.
 *
 */
class hopitauxController extends Controller
{
    /**
     * Lists all hopitaux entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hopitauxes = $em->getRepository('AppBundle:hopitaux')->findAll();

        return $this->render('hopitaux/index.html.twig', array(
            'hopitauxes' => $hopitauxes,
        ));
    }

    /**
     * Creates a new hopitaux entity.
     *
     */
    public function newAction(Request $request)
    {
        $hopitaux = new Hopitaux();
        $form = $this->createForm('AppBundle\Form\hopitauxType', $hopitaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hopitaux);
            $em->flush();

            return $this->redirectToRoute('hopitaux_show', array('id' => $hopitaux->getId()));
        }

        return $this->render('hopitaux/new.html.twig', array(
            'hopitaux' => $hopitaux,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hopitaux entity.
     *
     */
    public function showAction(hopitaux $hopitaux)
    {
        $deleteForm = $this->createDeleteForm($hopitaux);

        return $this->render('hopitaux/show.html.twig', array(
            'hopitaux' => $hopitaux,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing hopitaux entity.
     *
     */
    public function editAction(Request $request, hopitaux $hopitaux)
    {
        $deleteForm = $this->createDeleteForm($hopitaux);
        $editForm = $this->createForm('AppBundle\Form\hopitauxType', $hopitaux);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hopitaux_edit', array('id' => $hopitaux->getId()));
        }

        return $this->render('hopitaux/edit.html.twig', array(
            'hopitaux' => $hopitaux,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hopitaux entity.
     *
     */
    public function deleteAction(Request $request, hopitaux $hopitaux)
    {
        $form = $this->createDeleteForm($hopitaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hopitaux);
            $em->flush();
        }

        return $this->redirectToRoute('hopitaux_index');
    }

    /**
     * Creates a form to delete a hopitaux entity.
     *
     * @param hopitaux $hopitaux The hopitaux entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(hopitaux $hopitaux)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hopitaux_delete', array('id' => $hopitaux->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
