<?php

namespace App\Repository;

use App\Entity\Grower;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Grower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grower[]    findAll()
 * @method Grower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrowerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grower::class);
    }

    /**
     * @return Grower[] Returns an array of Grower objects
     */
    public function findByYearAndCropType($year, $cropType)
    {
        /*$em = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Grower g
            WHERE p.price > :price
            ORDER BY p.price ASC'
        )->setParameter('price', $price);

        // returns an array of Product objects
        return $query->execute();*/

        return $this->createQueryBuilder('g')
            ->leftJoin('g.farms', 'f')
            ->leftJoin('f.plantingEvents', 'pe')
            ->leftJoin('pe.cropType', 'ct')
            ->andWhere('YEAR(pe.date) = :year')
            ->andWhere('ct.name = :crop_type')
            ->setParameter('year', $year)
            ->setParameter('crop_type', $cropType)
            ->orderBy('pe.date', 'DESC')
            ->getQuery()
            ->getResult()
            //->getArrayResult()
        ;
    }
}
