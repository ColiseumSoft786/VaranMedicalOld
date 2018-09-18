<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\Horaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Horaire controller.
 *
 * @Route("horaire")
 */
class HoraireController extends Controller
{
    /**
     * Lists all horaire entities.
     *
     * @Route("/", name="horaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $horaires = $em->getRepository('DoctorsBundle:Horaire')->findAll();

        return $this->render('horaire/index.html.twig', array(
            'horaires' => $horaires,
        ));
    }

    /**
     * Creates a new horaire entity.
     *
     * @Route("/new", name="horaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $horaire = new Horaire();
        $form = $this->createForm('DoctorsBundle\Form\HoraireType', $horaire);
        $form->handleRequest($request);
        
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $idDoctor = $user->getIdTable();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($idDoctor);
        $locations = $em->getRepository('DoctorsBundle:Locations')->findBy(array('doctor' => $idDoctor, 'deleatedAt' => null, 'verified' => 1));

        $horaire = $em->getRepository('DoctorsBundle:Horaire')->findBy(array('locationId' => $locations));

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($horaire);
            $em->flush();

            return $this->redirectToRoute('horaire_show', array('id' => $horaire->getId()));
        }
        
        return $this->render('horaire/new.html.twig', array(
            'horaire' => $horaire,
            'locations' => $locations,
            'form' => $form->createView(),
            'horaires' => $horaire,
        ));
    }

    /**
     * Finds and displays a horaire entity.
     *
     * @Route("/{id}", name="horaire_show")
     * @Method("GET")
     */
    public function showAction(Horaire $horaire)
    {
        $deleteForm = $this->createDeleteForm($horaire);

        return $this->render('horaire/show.html.twig', array(
            'horaire' => $horaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing horaire entity.
     *
     * @Route("/{id}/edit", name="horaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Horaire $horaire)
    {
        $deleteForm = $this->createDeleteForm($horaire);
        $editForm = $this->createForm('DoctorsBundle\Form\HoraireType', $horaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horaire_edit', array('id' => $horaire->getId()));
        }

        return $this->render('horaire/edit.html.twig', array(
            'horaire' => $horaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a horaire entity.
     *
     * @Route("/{id}", name="horaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Horaire $horaire)
    {
        $form = $this->createDeleteForm($horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($horaire);
            $em->flush();
        }

        return $this->redirectToRoute('horaire_index');
    }

    /**
     * Creates a form to delete a horaire entity.
     *
     * @param Horaire $horaire The horaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Horaire $horaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('horaire_delete', array('id' => $horaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
     /**
     * create an horaire entity.
     *
     * @Route("/horaire/add", name="horaire_add")
     * @Method("POST")
     */
    public function addHoraireAction(Request $request)
    {
        $loc = $request->get('loc');
        
        $stime = $request->get('sHour');
        
        $etime = $request->get('eHour');
        
        $jours = $request->get('jour');
        
        $jourNum=0;
        if (is_array($jours)){
            foreach($jours as $jour){
                $horaire = $this->getDoctrine()->getRepository('DoctorsBundle:Horaire')->findOneBy(array('locationId' => $loc, 'jour' => $jour));
                $em = $this->getDoctrine()->getManager();
                $location = $this->getDoctrine()->getRepository('DoctorsBundle:Locations')->find($loc);
                $horaire->setLocationId($location);
                $horaire->setJour($jour);
                $horaire->setHeureDebut(\DateTime::createFromFormat('H:i', $stime[$jourNum]));
                $horaire->setHeureFin(\DateTime::createFromFormat('H:i', $etime[$jourNum]));
                $em->persist($horaire);
                $em->flush();
                $jourNum++;
            }
        }
        return $this->redirectToRoute('locations_index');
    }
    
    
    public function getHoraireByDoctorAction($doctor)
    {
        $em = $this->getDoctrine()->getManager();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($doctor);
        $locations = $em->getRepository('DoctorsBundle:Locations')->findBy(array('doctor' => $doctor, 'deleatedAt' => null, 'verified' => 1));

        $horaire = $em->getRepository('DoctorsBundle:Horaire')->findBy(array('locationId' => $locations));

        return $this->render('horaire/horaireByDoctor.html.twig', array(
            'horaires' => $horaire,
            'locations' => $locations,
        ));
    }
    
}