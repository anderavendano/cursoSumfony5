<?php

namespace App\Repository;

use App\Entity\Nota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nota[]    findAll()
 * @method Nota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nota::class);
    }

    public function getNotasAlumno($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT asig.nombre, n.nota, n.fecha
                FROM App:Nota n
                JOIN n.asignatura asig
                WHERE n.fecha IN (
                    SELECT MAX(notas.fecha)
                    FROM App:Nota notas
                    WHERE notas.alumno = :id
                    GROUP BY notas.asignatura
                )
                ORDER BY n.fecha DESC'
            )->setParameter('id', $id);
        return $query->getArrayResult();
    }

    public function getNotaMedia($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT AVG(n.nota)
                FROM App:Nota n
                WHERE n.fecha IN (
                    SELECT MAX(notas.fecha)
                    FROM App:Nota notas
                    WHERE notas.alumno = :id
                    GROUP BY notas.asignatura
                )
                ORDER BY n.fecha DESC'
            )->setParameter('id', $id);
        return $query->getSingleScalarResult();
    }
    // /**
    //  * @return Nota[] Returns an array of Nota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nota
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
