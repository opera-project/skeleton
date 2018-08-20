<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Opera\ListBlockBundle\BlockType\BlockListableInterface;
use Opera\CoreBundle\Entity\Block;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository implements BlockListableInterface
{
    public const ORDER_RECENT_FIRST = 'recent first';
    public const ORDER_ALPHABETICAL = 'alphabetical';

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function listableConfiguration() : array 
    {
        return [
            'templates' => [
                'name' => 'blocks/listable/listable_article.html.twig',
                'name2' => 'blocks/listable/listable_article_alternate.html.twig',
            ],
            'available_orders' => [
                self::ORDER_RECENT_FIRST,
                self::ORDER_ALPHABETICAL
            ]
        ];
    }

    public function filterForListableBlock(Block $block) : array
    {
        $blockConfig = $block->getConfiguration();
        
        $qb = $this->createQueryBuilder('a');

        if (isset($blockConfig['order'])) {
            switch ($blockConfig['order']) {
                case self::ORDER_RECENT_FIRST:
                    $qb->orderBy('a.createdAt', 'DESC');
                    break;
                case self::ORDER_ALPHABETICAL:
                    $qb->orderBy('a.title', 'ASC');
                    break;
                default:
                    // empty
                    break;
            }
        }

        if (isset($blockConfig['tags']) && $blockConfig['tags']) {
            $qb->innerJoin('a.tags', 't')
               ->andWhere('t.id IN (:tags)')
               ->setParameter('tags', $blockConfig['tags']);
        }

        if (isset($blockConfig['limit'])) {
            $qb->setMaxResults($blockConfig['limit']);
        }

        return $qb->getQuery()->getResult();
    }

}
