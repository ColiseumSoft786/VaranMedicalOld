<?php

namespace DataBundle\Services;

use DataBundle\Entity\Detailstatistic;
use DataBundle\Entity\Statistic;
use Doctrine\ORM\EntityManager;

class StatService
{
    private $em;
    private $statId='';

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function setStat($docId,$statName,$currentDate)
    {

        $statCheck = $this->em->getRepository(Statistic::class)->findOneBy( array('doctor' => $docId, 'statname' => $statName));

        if(empty($statCheck))
        {


            $stat = new \DataBundle\Entity\Statistic();
            $getDoc = $this->em->getRepository('DataBundle:Doctors')->find($docId);
            $stat->setDoctor($getDoc);
            $stat->setStatName($statName);
            $this->em->persist($stat);
            $this->em->flush();
            $this->DStat($currentDate,$stat->getId());
        }
        else
        {
            $this->statId = $statCheck->getId();
            $this->DStat($currentDate,$this->statId);
        }


    }

    public function DStat($currentDate,$statID)
    {
        $DetailStatCheck = $this->em->getRepository(Detailstatistic::class)->findBy( array('statistic'=> $statID, 'date' => $currentDate));
        if(empty($DetailStatCheck))
        {
            $statIdObj = $this->em->getRepository(Statistic::class)->find($statID);
            $detailStat = new Detailstatistic();
            $detailStat->setStatistic($statIdObj);
            $detailStat->setDate($currentDate);
            $detailStat->setValue(1);
            $this->em->persist($detailStat);
            $this->em->flush();
        }
        else
        {
            $dStat = $this->em->getRepository( Detailstatistic::class)->findOneBy( array('statistic'=> $this->statId, 'date'=> $currentDate));
            $cValue = $dStat->getValue();
            $cValue = $cValue + 1;
            $dStat->setValue($cValue);
            $this->em->flush();
        }
    }
}