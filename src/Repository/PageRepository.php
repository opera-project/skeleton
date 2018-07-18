<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Page::class);
    }

    public function findOnePublishedWithoutRouteAndSlug($slug)
    {
        return $this->createQueryBuilder('p')
                    ->innerJoin('p.layout', 'l')
                    ->addSelect('l')
                    ->andWhere('p.route IS NULL')
                    ->andWhere('p.slug = :slug')
                    ->andWhere('p.status = :status')
                    ->setParameter('slug', $slug)
                    ->setParameter('status', 'published')
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    public function findAllRoutes()
    {
        return $this->createQueryBuilder('p')
                    ->andWhere('p.route IS NOT NULL')
                    ->getQuery()
                    ->getResult();
    }

    public function findOnePublishedWithRoute(string $route)
    {
        return $this->createQueryBuilder('p')
                    ->innerJoin('p.layout', 'l')
                    ->addSelect('l')
                    ->andWhere('p.route = :route')
                    ->andWhere('p.status = :status')
                    ->setParameter('route', $route)
                    ->setParameter('status', 'published')
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
