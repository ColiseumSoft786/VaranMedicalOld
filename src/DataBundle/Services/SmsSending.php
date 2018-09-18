<?php
/**
 * Created by PhpStorm.
 * User: Abuza
 * Date: 7/14/2018
 * Time: 5:15 PM
 */

namespace DataBundle\Services;


use Octopush\Api\Client;

class SmsSending
{
    private $email = "abuzar2407@gmail.com";
    private $key = "QH251ERgXEBOEBmvtJWuJ0RoemTy3gI0";


    public function reminder($app,$doctor,$patient,$user){
        $client= new Client($this->email,$this->key);
        $client->setSmsRecipients(['+923336629694']);
        $client->setSmsSender('Varan');
        $client->setWithReplies();

        $text = "Hello, ". $patient->getFirstname() ." ". $patient->getLastname() ."%0a
                 This the is reminder by ". $doctor->getFirstname() ." ". $doctor->getLastname() .". For the following Appointment (be on time):%0a
                    Appointment Location: %0a
                    Name: ". $app->getSeance()->getCalendrie()->getLocation()->getName() ."%0a
                    Address: ". $app->getSeance()->getCalendrie()->getLocation()->getAdresse() ."%0a
                    Ville: ". $app->getSeance()->getCalendrie()->getLocation()->getVille() ."%0a
                    Zip Code: ". $app->getSeance()->getCalendrie()->getLocation()->getCodezip() ."%0a
                    Appointment Date: ". $app->getSeance()->getCalendrie()->getDate()->format('d-m-Y') ."%0a
                    Appointment Time: ". $app->getSeance()->getHeurdebut()->format('H:i') ." - ". $app->getSeance()->getHeurfin()->format('H:i') ."%0a
                    %0a
                    Best Regards, %0a
                    Varan Team";
        $client->send($text);
    }
    public function createAppointment($app,$doctor,$patient,$user){
        $client= new Client($this->email,$this->key);
        $client->setSmsRecipients(['+923336629694']);
        $client->setSmsSender('Varan');
        $client->setWithReplies();

        $text = "Hello, ". $patient->getFirstname() ." ". $patient->getLastname() ."%0a
                 We hope you are fine, your appointment has been created with ". $doctor->getFirstname() ." ". $doctor->getLastname() .". For the following Appointment (be on time):%0a
                    Appointment Location: %0a
                    Name: ". $app->getSeance()->getCalendrie()->getLocation()->getName() ."%0a
                    Address: ". $app->getSeance()->getCalendrie()->getLocation()->getAdresse() ."%0a
                    Ville: ". $app->getSeance()->getCalendrie()->getLocation()->getVille() ."%0a
                    Zip Code: ". $app->getSeance()->getCalendrie()->getLocation()->getCodezip() ."%0a
                    Appointment Date: ". $app->getSeance()->getCalendrie()->getDate()->format('d-m-Y') ."%0a
                    Appointment Time: ". $app->getSeance()->getHeurdebut()->format('H:i') ." - ". $app->getSeance()->getHeurfin()->format('H:i') ."%0a
                    %0a
                    Best Regards, %0a
                    Varan Team";
        $client->send($text);
    }
    public function statuschange($app,$doctor,$patient,$user){
        $client= new Client($this->email,$this->key);
        $client->setSmsRecipients(['+923336629694']);
        $client->setSmsSender('Varan');
        $client->setWithReplies();

        $text = "Hello, ". $patient->getFirstname() ." ". $patient->getLastname() ."%0a
                 We hope you are fine, your appointment status has been changed by ". $doctor->getFirstname() ." ". $doctor->getLastname() .". For the following Appointment (be on time):%0a
                    Status: ".$app->getEtat()."%0a
                    Appointment Location: %0a
                    Name: ". $app->getSeance()->getCalendrie()->getLocation()->getName() ."%0a
                    Address: ". $app->getSeance()->getCalendrie()->getLocation()->getAdresse() ."%0a
                    Ville: ". $app->getSeance()->getCalendrie()->getLocation()->getVille() ."%0a
                    Zip Code: ". $app->getSeance()->getCalendrie()->getLocation()->getCodezip() ."%0a
                    Appointment Date: ". $app->getSeance()->getCalendrie()->getDate()->format('d-m-Y') ."%0a
                    Appointment Time: ". $app->getSeance()->getHeurdebut()->format('H:i') ." - ". $app->getSeance()->getHeurfin()->format('H:i') ."%0a
                    %0a
                    Best Regards, %0a
                    Varan Team";
        $client->send($text);
    }
    public function cutcopy($app,$doctor,$patient,$oldsea,$newsea,$type,$user){
        $client= new Client($this->email,$this->key);
        $client->setSmsRecipients(['+923336629694']);
        $client->setSmsSender('Varan');
        $client->setWithReplies();

        $text = "Hello, ". $patient->getFirstname() ." ". $patient->getLastname() ."%0a
                 We hope you are fine, your appointment is ".$type." by ". $doctor->getFirstname() ." ". $doctor->getLastname() .". For the following Appointment (be on time):%0a
                    Status: ".$app->getEtat()."%0a
                    Old Appointment Location: %0a
                    Name: ". $oldsea->getCalendrie()->getLocation()->getName() ."%0a
                    Address: ". $oldsea->getCalendrie()->getLocation()->getAdresse() ."%0a
                    Ville: ". $oldsea->getCalendrie()->getLocation()->getVille() ."%0a
                    Zip Code: ". $oldsea->getCalendrie()->getLocation()->getCodezip() ."%0a
                    Appointment Date: ". $oldsea->getCalendrie()->getDate()->format('d-m-Y') ."%0a
                    Appointment Time: ". $oldsea->getHeurdebut()->format('H:i') ." - ". $oldsea->getHeurfin()->format('H:i') ."%0a
                    New Appointment Location: %0a
                    Name: ". $newsea->getCalendrie()->getLocation()->getName() ."%0a
                    Address: ". $newsea->getCalendrie()->getLocation()->getAdresse() ."%0a
                    Ville: ". $newsea->getCalendrie()->getLocation()->getVille() ."%0a
                    Zip Code: ". $newsea->getCalendrie()->getLocation()->getCodezip() ."%0a
                    Appointment Date: ". $newsea->getCalendrie()->getDate()->format('d-m-Y') ."%0a
                    Appointment Time: ". $newsea->getHeurdebut()->format('H:i') ." - ". $oldsea->getHeurfin()->format('H:i') ."%0a
                 
                    Best Regards, %0a
                    Varan Team";
        $client->send($text);
    }


}