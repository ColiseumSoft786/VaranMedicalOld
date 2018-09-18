<?php
/**
 * Created by PhpStorm.
 * User: Abuza
 * Date: 8/7/2018
 * Time: 2:44 PM
 */

namespace UserBundle\Listener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\RememberMeToken;
use UserBundle\Entity\Ip;


class LoginListener
{

    /**
     *
     * @var Doctrine
     */
    private $em;

    /**
     * @var SessionInterface
     */
    private $session;
    private $tokenStorage;
    private $request;

    public function __construct(TokenStorage $tokenStorage,Doctrine $em, SessionInterface $session)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
        $this->session = $session;
        $this->request = $_REQUEST;
    }
    /**
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $ip = $_SERVER['REMOTE_ADDR'];
        $ipcheck = $this->em->getRepository(Ip::class)->findOneBy(array(
            'user' => $user->getId(),
            'address' => $ip
        ));
        if ($ipcheck == null){
            $obj = new Ip();
            $obj->setUser($user->getId());
            $obj->setAddress($ip);
            $em = $this->em->getManager();
            $em->persist($obj);
            $em->flush();
        }
        $cookie_name = "listed";
        $cookie_value = "saved";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

    }
}