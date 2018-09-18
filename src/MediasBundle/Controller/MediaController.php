<?php

namespace MediasBundle\Controller;

use MediasBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Medium controller.
 *
 */
class MediaController extends Controller
{
    /**
     * Lists all medium entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $media = $em->getRepository('MediasBundle:Media')->findAll();

        return $this->render('media/index.html.twig', array(
            'media' => $media,
        ));
    }

    /**
     * Creates a new medium entity.
     *
     */
    public function newAction(Request $request)
    {
        $media = new Media();
        $form = $this->createForm('MediasBundle\Form\MediaType', $media);
        $form->handleRequest($request);
        $poids_max = 512000; // Poids max de l'image en octets (1Ko = 1024 octets)
        $repertoire = 'web/assets/images/uploads/'; // Repertoire d'upload
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->get('fichier') != null){
                // On vérifit le type du fichier
                if ($_FILES['fichier']['type'] != 'image/png' && $_FILES['fichier']['type'] != 'image/jpeg' && $_FILES['fichier']['type'] != 'image/jpg' && $_FILES['fichier']['type'] != 'image/gif')
                {
                    $erreur = 'Le fichier doit être au format *.jpeg, *.gif ou *.png .';
                }

                // On vérifit le poids de l'image
                elseif ($_FILES['fichier']['size'] > $poids_max)
                {
                    $erreur = 'L\'image doit être inférieur à ' . $poids_max/1024 . 'Ko.';
                }

                // On vérifit si le répertoire d'upload existe
                elseif (!file_exists($repertoire))
                {
                    $erreur = 'Erreur, le dossier d\'upload n\'existe pas.';
                }

                // Si il y a une erreur on l'affiche sinon on peut uploader
                if(isset($erreur))
                {
                    echo '' . $erreur . '<br><a href="javascript:history.back(1)">Retour</a>';
                }
                else
                {

                    // On définit l'extention du fichier puis on le nomme par le timestamp actuel
                    if ($_FILES['fichier']['type'] == 'image/jpeg') { $extention = '.jpeg'; }
                    if ($_FILES['fichier']['type'] == 'image/jpeg') { $extention = '.jpg'; }
                    if ($_FILES['fichier']['type'] == 'image/png') { $extention = '.png'; }
                    if ($_FILES['fichier']['type'] == 'image/gif') { $extention = '.gif'; }
                    $nom_fichier = time().$extention;

                    // On upload le fichier sur le serveur.
                    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
                    {
                        $media->setPath($nom_fichier);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($media);
                        $em->flush();
                        return $this->redirectToRoute('media_show', array('id' => $media->getId()));
                    }
                    else
                    {
                        echo 'L\'image n\'a pas pu être uploadée sur le serveur.';
                    }

                }

            }



        }

        return $this->render('media/new.html.twig', array(
            'media' => $media,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medium entity.
     *
     */
    public function showAction(Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);

        return $this->render('media/show.html.twig', array(
            'medium' => $medium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medium entity.
     *
     */
    public function editAction(Request $request, Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);
        $editForm = $this->createForm('MediasBundle\Form\MediaType', $medium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('media_edit', array('id' => $medium->getId()));
        }

        return $this->render('media/edit.html.twig', array(
            'medium' => $medium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medium entity.
     *
     */
    public function deleteAction(Request $request, Media $medium)
    {
        $form = $this->createDeleteForm($medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medium);
            $em->flush();
        }

        return $this->redirectToRoute('media_index');
    }

    /**
     * Creates a form to delete a medium entity.
     *
     * @param Media $medium The medium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Media $medium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('media_delete', array('id' => $medium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
