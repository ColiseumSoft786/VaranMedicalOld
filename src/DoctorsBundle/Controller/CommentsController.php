<?php

namespace DoctorsBundle\Controller;

use DoctorsBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentsController extends Controller
{
    public function indexAction($location){
        $Comments = $this->getDoctrine()->getRepository('DoctorsBundle:Comments')->findBy(array('location'=> $location));
        $user = $this->getUser();
        $doctor = $user->getIdTable();
        $doctor = $this->getDoctrine()->getRepository('DoctorsBundle:Doctors')->find($doctor);

        return $this->render('Comments/index.html.twig',array(
            'doctor' => $doctor,
            'comments'=>$Comments,
            'location' => $location
        ));
    }
    public function newAction(Request $request,$location){
        if($request->getMethod() == "POST"){
            $comment = new Comments();
            $comment->setComment($request->get('comment'));
            $comment->setLocation($this->getDoctrine()->getRepository('DoctorsBundle:Locations')->find($location));
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('doctors_comments',array('location' => $location)));
        }
        $user = $this->getUser();
        $doctor = $user->getIdTable();
        $doctor = $this->getDoctrine()->getRepository('DoctorsBundle:Doctors')->find($doctor);
        return $this->render('Comments/new.html.twig',array(
            'doctor' => $doctor,
            'location' => $location
        ));
    }
    public function deleteAction($comment){
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('DoctorsBundle:Comments')->find($comment);
        $location = $comment->getLocation()->getId();
        $em->remove($comment);
        $em->flush();
        return $this->redirect($this->generateUrl('doctors_comments',array('location' => $location)));
    }
    public function editAction(Request $request,$comment){
        if($request->getMethod() == "POST"){
            $em = $this->getDoctrine()->getManager();
            $comment= $em->getRepository('DoctorsBundle:Comments')->find($comment);
            $comment->setComment($request->get('commentname'));
            $em->flush();
            return $this->redirect($this->generateUrl('doctors_comments',array('location' => $comment->getLocation()->getId())));
        }
        $comment = $this->getDoctrine()->getRepository('DoctorsBundle:Comments')->find($comment);
        $user = $this->getUser();
        $doctor = $user->getIdTable();
        $doctor = $this->getDoctrine()->getRepository('DoctorsBundle:Doctors')->find($doctor);
        return $this->render('Comments/edit.html.twig',array(
            'doctor' => $doctor,
            'comment' => $comment
        ));
    }
}
