<?php

namespace PatientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PatientBundle:Default:index.html.twig');
    }
}
