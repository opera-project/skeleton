<?php

namespace App\Repository;

use App\Entity\Block;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Page;

/**
 * @method Block|null find($id, $lockMode = null, $lockVersion = null)
 * @method Block|null findOneBy(array $criteria, array $orderBy = null)
 * @method Block[]    findAll()
 * @method Block[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlockRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Block::class);
    }

    public function findForAreaAndPage(string $area, ?Page $page = null)
    {
        if (!$page) {
            return $this->findForAreaAndGlobalPage($area);
        }

        return $this->createQueryBuilder('b')
                    ->andWhere('b.page = :page')
                    ->setParameter(':page', $page)
                    ->andWhere('b.area = :area')
                    ->setParameter(':area', $area)
                    ->orderBy('b.position')
                    ->getQuery()
                    ->getResult()
        ;
    }

    public function findForAreaAndGlobalPage(string $area)
    {
        return $this->createQueryBuilder('b')
                    ->innerJoin('b.page', 'p')
                    ->andWhere('p.slug = :slug')
                    ->setParameter(':slug', '_global')
                    ->andWhere('b.area = :area')
                    ->setParameter(':area', $area)
                    ->orderBy('b.position')
                    ->getQuery()
                    ->getResult()
        ;
    }

//    /**
//     * @return Block[] Returns an array of Block objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Block
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
