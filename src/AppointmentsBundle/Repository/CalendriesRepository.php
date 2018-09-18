<?php

namespace AppointmentsBundle\Repository;

/**
 * CalendriesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CalendriesRepository extends \Doctrine\ORM\EntityRepository
{
    public function absence($id, $absence) {
        $qb = $this->createQueryBuilder('l')
            ->update('AppointmentsBundle:Calendries', 'l')
            ->set('l.absence', ':d')
            ->where('l.id = ?2')
            ->setParameter('d', $absence)
            ->setParameter(2, $id);
        return $qb->getQuery()->getResult();
    }
    public function publier($id, $public) {
        $qb = $this->createQueryBuilder('l')
            ->update('AppointmentsBundle:Calendries', 'l')
            ->set('l.public', ':d')
            ->where('l.id = ?2')
            ->setParameter('d', $public)
            ->setParameter(2, $id);
        return $qb->getQuery()->getResult();
    }

    public function delete($id) {
        $now =  (new \DateTime())->format('Y-m-d H:i:s');
        $qb = $this->createQueryBuilder('l')
            ->update('AppointmentsBundle:Calendries', 'l')
            ->set('l.deleatedAt', ':d')
            ->where('l.id = ?2')
            ->setParameter('d', $now)
            ->setParameter(2, $id);
        return $qb->getQuery()->getResult();
    }

    public function activation($id, $active) {
        $qb = $this->createQueryBuilder('l')
            ->update('AppointmentsBundle:Calendries', 'l')
            ->set('l.active', ':d')
            ->where('l.id = ?2')
            ->setParameter('d', $active)
            ->setParameter(2, $id);
        return $qb->getQuery()->getResult();
    }

    public function getCalendrieByLocation($location){
        $qb = $this->createQueryBuilder('c')
            ->select('c')

            ->where('c.location = :location')
            ->setParameter('location', $location)
            ->orderBy('c.date', 'DESC');
        return $qb->getQuery()->getResult();
    }
    public function getCalendrieBydate($date,$location){
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.location = :location')
            ->andWhere('c.date LIKE :date')
            ->setParameter('location', $location)
            ->setParameter('date', $date);
        return $qb->getQuery()->getResult();
    }

    public function getCalendrieByLocationByDate($location, $date){
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.location = :location')
            ->andWhere('c.date = :date')
            ->setParameter('location', $location)
            ->setParameter('date', $date)
            ->orderBy('c.date', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function getWeekSeancesByDoctor($doctor){
        $now = date("Y-m-d");
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->innerJoin('c.location', 'l')
            ->innerJoin('l.doctor', 'd')
            ->where('d.id = :doctor')
            ->andWhere('c.date <= :week')
            ->andWhere('c.date >= :today')
            ->setParameter('week', new \DateTime('+1 week'))
            ->setParameter('today', $now)
            ->setParameter('doctor', $doctor)
            ->orderBy('c.date');

        return $qb->getQuery()->getResult();
    }

}