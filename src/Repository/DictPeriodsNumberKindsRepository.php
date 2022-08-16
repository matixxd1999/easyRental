<?php

namespace App\Repository;

use App\Entity\DictPeriodsNumberKinds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DictPeriodsNumberKinds>
 *
 * @method DictPeriodsNumberKinds|null find($id, $lockMode = null, $lockVersion = null)
 * @method DictPeriodsNumberKinds|null findOneBy(array $criteria, array $orderBy = null)
 * @method DictPeriodsNumberKinds[]    findAll()
 * @method DictPeriodsNumberKinds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DictPeriodsNumberKindsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DictPeriodsNumberKinds::class);
    }

    public function add(DictPeriodsNumberKinds $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DictPeriodsNumberKinds $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DictPeriodsNumberKinds[] Returns an array of DictPeriodsNumberKinds objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DictPeriodsNumberKinds
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
