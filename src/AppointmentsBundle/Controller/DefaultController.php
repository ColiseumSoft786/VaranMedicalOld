<?php

namespace AppointmentsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppointmentsBundle:Default:index.html.twig');
    }
}
