<?php

namespace MediasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MediasBundle:Default:index.html.twig');
    }


}
