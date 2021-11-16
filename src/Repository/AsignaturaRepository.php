<?php

namespace App\Repository;

use App\Entity\Asignatura;
use App\Entity\Alumno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asignatura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asignatura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asignatura[]    findAll()
 * @method Asignatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsignaturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asignatura::class);
    }
    public function getAsignaturasAlumno($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT asig, a
                FROM App:Asignatura asig
                JOIN asig.alumno a
                WHERE a.id = :id'
            )->setParameter('id', $id);
        return $query->getResult();
    }

    /*public function getAsignaturasSinAlumno($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT asig.id, asig.nombre
                FROM App:Asignatura asig
                JOIN asig.alumno a
                WHERE a.id = :id'
            )->setParameter('id', $id);
        return $query->getArrayResult();
    }
*/
    /*public function deleteAsignaturaAlumno($id)
    {

        return $query->getArrayResult();
    }*/
    // /**
    //  * @return Asignatura[] Returns an array of Asignatura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Asignatura
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
