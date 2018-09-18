<?php

namespace UserBundle\Controller;

use DoctorsBundle\Entity\Doctors;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Ip;
use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
/**
 * User controller.
 *
 */
class UserController extends Controller
{
    public function ipcheckAction(Request $request){
        $user = $this->get('fos_user.user_manager')->findUserByUsername($request->get('_username'));
        if ($user != null){
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $bool = $encoder->isPasswordValid($user->getPassword(),$request->get('_password'),$user->getSalt());
            if (!$bool){
                return new Response('false');
            }
            $ip = $_SERVER['REMOTE_ADDR'];
            $ips = $this->getDoctrine()->getRepository(Ip::class)->findOneBy(array(
                'user' => $user->getId(),
                'address' => $ip
            ));
            if ($ips != null){
                if(isset($_COOKIE['listed'])) {
                    return new Response('true');
                }
            }
            $email = $user->getEmail();
            $code=rand(10000,99999);
            $es = $this->get('EmailSending');
//            $es->sendcode($code,$email);
            /*$name = $_SERVER['HTTP_X_FORWARDED_FOR'];*/


            $query = json_decode(@unserialize(file_get_contents('http://ip-api.com/json/'.$ip)));
            
            return new Response($code);
        }
        return new Response('false');
    }

    /**
     *
    @Route("/deleteCategory/{id}", name = "deleteCategory")
     */
    public function deleteCategoryAction($id)
    {
        if ($this->isLogedIn == true)
        {
            $em = $this->getDoctrine()->getManager();
            $delete_category = $em->getRepository(Category::class)->find($id);
            $em_product = $this->getDoctrine()->getManager();
            $products = $em_product->getRepository(Product::class)->findBy(['c' => $delete_category->id]);
            foreach ($products as $oneProduct)
            {
                $em_product->remove($oneProduct);
                $em_product->flush();
            }
            $em->remove($delete_category);
            $em->flush();
            return $this->redirectToRoute("getCategories");
        }

        else
        {
            return $this->redirectToRoute("loginAdmin");
        }

    }








    public function loginAction(Request $request)
    {

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        return $this->renderLogin2(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
    }
    /**
    * Renders the login template with the given parameters. Overwrite this function in
         * an extended controller to provide additional data for the login template.
         *
         * @param array $data
         *
         * @return Response
         */
    protected function renderLogin2(array $data)
    {
        return $this->render('user/login2.html.twig', $data);
    }

    public function profilEditAction(Request $request, $doctor){
        $em = $this->getDoctrine()->getManager();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($doctor);

        $form = $this->createForm('DoctorsBundle\Form\DoctorsType', $doctor);
        $form->handleRequest($request);

        return $this->render('user/profilupdate.html.twig', array(
            'doctor' => $doctor,
            'form' => $form->createView(),
        ));
    }

    public function isVerifiedAction($doctor){
        $em = $this->getDoctrine()->getManager();
        $doctor = $em->getRepository('UserBundle:User')->findOneBy(array('idTable' => $doctor));
        if (!empty($doctor)){
            if ($doctor->getVerifier() == 1){
                return new Response(1);
            }else{
                return new Response(0);
            }
        }else{
            return new Response(0);
        }
    }

    public function getPatientPictureAction($id){
        $em = $this->getDoctrine()->getManager();
        $patient = $em->getRepository('PatientBundle:Patient')->find($id);

        return new Response($patient->getProfilPicture());
    }

    public function getDoctorNameAction($id){
        $em = $this->getDoctrine()->getManager();
        $doctor = $em->getRepository('DoctorsBundle:Doctors')->find($id);

        return new Response($doctor->getFirstName().' '.$doctor->getLastName());
    }
    public function getPatientNameAction($id){
        $em = $this->getDoctrine()->getManager();
        $patient = $em->getRepository('PatientBundle:Patient')->find($id);

        return new Response($patient->getFirstName().' '.$patient->getLastName());
    }

    public function createUserAction(Request $request) {
        $entity = new User();
        $form = $this->createForm('UserBundle\Form\UserType', $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->get('role') == 'doctors') {
                $entity->addRole('ROLE_DOCTOR');
            }
            if ($request->get('role') == 'patients') {
                $entity->addRole('ROLE_PATIENT');
            }
            $entity->setEnabled(true);

            $em= $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $message = 'success';

            $session = $request->getSession();

            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;

            // get the error if any (works with forward and redirect -- see below)
            if ($request->attributes->has($authErrorKey)) {
                $error = $request->attributes->get($authErrorKey);
            } elseif (null !== $session && $session->has($authErrorKey)) {
                $error = $session->get($authErrorKey);
                $session->remove($authErrorKey);
            } else {
                $error = null;
            }

            if (!$error instanceof AuthenticationException) {
                $error = null; // The value does not come from the security component.
            }

            // last username entered by the user
            $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

            $csrfToken = $this->has('security.csrf.token_manager')
                ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
                : null;

            return $this->renderLogin(array(
                'last_username' => $lastUsername,
                'error' => $error,
                'csrf_token' => $csrfToken,
                'message' => $message
            ));
        }else{
            return new Response('erreur');
        }
    }



    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return Response
     */
    protected function renderLogin(array $data)
    {
        return $this->render('user/login.html.twig', $data);
    }

    public function verifierMailAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        if ($request->isXmlHttpRequest()) {
            $email = $request->request->get('email');
            $test = $this->getDoctrine()->getRepository('UserBundle:User')->findBy(array('email' => $email));
            if ($test == null){
                return new Response('dispo');
            }else{
                return new Response('noDispo');
            }
        }
    }

    public function verifierUserNameAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        if ($request->isXmlHttpRequest()) {
            $username = $request->request->get('username');
            $test = $this->getDoctrine()->getRepository('UserBundle:User')->findBy(array('username' => $username));
            if ($test == null){
                return new Response('dispo');
            }else{
                return new Response('noDispo');
            }
        }
    }

    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('UserBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function profilAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_PATIENT')) {
            $doctor = $em->getRepository('PatientBundle:Patient')->find($id);
        }else if(true === $this->get('security.authorization_checker')->isGranted('ROLE_DOCTOR')){
            $user = $em->getRepository('UserBundle:User')->find($id);
            if($user == null){
                die("Il n'existe aucun docteur avec cette id=$id ");
            }
            $doctor = $em->getRepository(Doctors::class)->find($user->getIdTable());
        }
        return $this->render('user/profil.html.twig', array(
            'doctor' => $doctor
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('UserBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}