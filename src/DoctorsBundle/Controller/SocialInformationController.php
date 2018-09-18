<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\SocialInformation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Socialinformation controller.
 *
 */
class SocialInformationController extends Controller
{
    /**
     * Lists all socialInformation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $socialInformations = $em->getRepository('DoctorsBundle:SocialInformation')->findAll();

        return $this->render('socialinformation/index.html.twig', array(
            'socialInformations' => $socialInformations,
        ));
    }

    /**
     * Creates a new socialInformation entity.
     *
     */
    public function newAction(Request $request)
    {
        $socialInformation = new Socialinformation();
        $form = $this->createForm('DoctorsBundle\Form\SocialInformationType', $socialInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($socialInformation);
            $em->flush();

            return $this->redirectToRoute('socialinformation_show', array('id' => $socialInformation->getId()));
        }

        return $this->render('socialinformation/new.html.twig', array(
            'socialInformation' => $socialInformation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a socialInformation entity.
     *
     */
    public function showAction(SocialInformation $socialInformation)
    {
        $deleteForm = $this->createDeleteForm($socialInformation);

        return $this->render('socialinformation/show.html.twig', array(
            'socialInformation' => $socialInformation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing socialInformation entity.
     *
     */
    public function editAction(Request $request, SocialInformation $socialInformation)
    {
        $deleteForm = $this->createDeleteForm($socialInformation);
        $editForm = $this->createForm('DoctorsBundle\Form\SocialInformationType', $socialInformation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('socialinformation_edit', array('id' => $socialInformation->getId()));
        }

        return $this->render('socialinformation/edit.html.twig', array(
            'socialInformation' => $socialInformation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a socialInformation entity.
     *
     */
    public function deleteAction(Request $request, SocialInformation $socialInformation)
    {
        $form = $this->createDeleteForm($socialInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socialInformation);
            $em->flush();
        }

        return $this->redirectToRoute('socialinformation_index');
    }

    /**
     * Creates a form to delete a socialInformation entity.
     *
     * @param SocialInformation $socialInformation The socialInformation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SocialInformation $socialInformation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('socialinformation_delete', array('id' => $socialInformation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
