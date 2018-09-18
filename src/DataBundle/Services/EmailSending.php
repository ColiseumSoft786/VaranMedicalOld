<?php
/**
 * Created by PhpStorm.
 * User: Abuza
 * Date: 7/5/2018
 * Time: 11:11 PM
 */

namespace DataBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class EmailSending
{
    private $email = "projectcoliseum@zoho.com";
    private $name = "Varan.fr";
    private $twig;
    private $mailer;
    public function __construct(\Swift_Mailer $mailer,\Twig_Environment $twig )
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }
    public function createAppointment($appointment,$doctor,$patient,$user){
        $message = \Swift_Message::newInstance()
            ->setSubject('Varan.fr, Appointment Created')
            ->setFrom($this->email,$this->name)
            ->setTo('abuzar2407@hotmail.com')
            ->setCharset('UTF-8')
            ->setBody(
                $this->twig->render('DataBundle:Emails:DoctorAppointment.html.twig',
                    array(
                        'app' => $appointment,
                        'doctor' => $doctor,
                        'patient' => $patient,
                        'id' => $user->getId()
                    )
                ),
                'text/html'
            );
        $this->mailer->send($message);

        return true;
    }
    public function statuschange($appointment,$doctor,$patient,$user){
        $message = \Swift_Message::newInstance()
            ->setSubject('Varan.fr, Appointment Status Changed')
            ->setFrom($this->email,$this->name)
            ->setTo('abuzar2407@hotmail.com')
            ->setCharset('UTF-8')
            ->setBody(
                $this->twig->render('DataBundle:Emails:statuschange.html.twig',
                    array(
                        'app' => $appointment,
                        'doctor' => $doctor,
                        'patient' => $patient,
                        'id' => $user->getId()
                    )
                ),
                'text/html'
            );
        $this->mailer->send($message);

        return true;
    }
    public function reminder($appointment,$doctor,$patient,$user,$att){
        $message = \Swift_Message::newInstance()
            ->setSubject('Varan.fr, Appointment Reminder')
            ->setFrom($this->email,$this->name)
            ->setTo('abuzar2407@hotmail.com')
            ->setCharset('UTF-8')
            ->setBody(
                $this->twig->render('DataBundle:Emails:statuschange.html.twig',
                    array(
                        'app' => $appointment,
                        'doctor' => $doctor,
                        'patient' => $patient,
                        'id' => $user->getId()
                    )
                ),
                'text/html'
            );
        if($att != ""){
            $message->attach(
                $att
            );
        }
        $this->mailer->send($message);

        return true;
    }
    public function cutcopy($appointment,$doctor,$patient,$oldsea,$newsea,$type,$user){
        $message = \Swift_Message::newInstance()
            ->setSubject('Varan.fr, Appointment Update Information')
            ->setFrom($this->email,$this->name)
            ->setTo('abuzar2407@hotmail.com')
            ->setCharset('UTF-8')
            ->setBody(
                $this->twig->render('DataBundle:Emails:cutcopy.html.twig',
                    array(
                        'app' => $appointment,
                        'doctor' => $doctor,
                        'patient' => $patient,
                        'oldsea' => $oldsea,
                        'newsea' => $newsea,
                        'type' => $type,
                        'id' => $user->getId()
                    )
                ),
                'text/html'
            );
        $this->mailer->send($message);

        return true;
    }
    public function sendcode($code,$email){
        $message = \Swift_Message::newInstance()
            ->setSubject('Varan.fr, Registration Code')
            ->setFrom($this->email,$this->name)
            ->setTo('abuzar2407@hotmail.com')
            ->setCharset('UTF-8')
            ->setBody(
                "Code: $code",
                'text/html'
            );
        $this->mailer->send($message);

        return true;
    }


}