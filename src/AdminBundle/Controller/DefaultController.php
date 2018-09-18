<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private $loggedin = false;
    private $user = null;
    public function __construct()
    {
        if(isset($_SESSION['user'])){
            $this->user = $_SESSION['user'];
            $this->loggedin = true;
        }
    }
   
    public function loginAction(Request $request){
        if(!$this->loggedin){
            if($request->getMethod() == "POST"){
                $user = $this->getDoctrine()->getRepository('DataBundle:Admin')->findOneBy(array('name' => $request->get('user'), 'password' => $request->get('pass')));
                if($user != null){
                    if($user->getPassword() == $request->get('pass')){
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        else{
                            session_destroy();
                            session_start();
                        }
                        $_SESSION['user'] = $user;
                        return $this->redirect($this->generateUrl('admin_homepage'));
                    }
                }
                return $this->render('AdminBundle:Default:login.html.twig', array('err' => "Username or Password is not Correct"));
            }
            return $this->render('AdminBundle:Default:login.html.twig',array('err' => ""));
        }
        return $this->redirect($this->generateUrl('admin_homepage'));

    }
    public function indexAction()
    {
        if($this->loggedin){
            $username = $this->user->getName();
            return $this->render('AdminBundle:Default:index.html.twig',array(
                'username' => $username
            ));
        }
        return $this->redirect($this->generateUrl('admin_homepage_login'));

    }
    public function logoutAction(){
        session_destroy();
        $this->loggedin = false;
        return $this->redirect($this->generateUrl('admin_homepage_login'));

    }
}
