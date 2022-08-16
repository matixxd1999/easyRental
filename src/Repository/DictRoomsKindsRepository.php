<?php

namespace App\Repository;

use App\Entity\DictRoomsKinds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DictRoomsKinds>
 *
 * @method DictRoomsKinds|null find($id, $lockMode = null, $lockVersion = null)
 * @method DictRoomsKinds|null findOneBy(array $criteria, array $orderBy = null)
 * @method DictRoomsKinds[]    findAll()
 * @method DictRoomsKinds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DictRoomsKindsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DictRoomsKinds::class);
    }

    public function add(DictRoomsKinds $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DictRoomsKinds $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DictRoomsKinds[] Returns an array of DictRoomsKinds objects
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

//    public function findOneBySomeField($value): ?DictRoomsKinds
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
