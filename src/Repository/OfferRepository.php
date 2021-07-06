<?php

namespace App\Repository;

use App\Entity\Offer;
use App\Entity\SearchOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    public function findBySearch(SearchOffer $searchOffer): array
    {
        $qb = $this->createQueryBuilder('o')
            ->andWhere('o.title LIKE :title')
            ->setParameter('title', '%' . $searchOffer->getTitle() . '%');
        if ($searchOffer->getCategory()) {
            $qb->andWhere('o.category = :category')
                ->setParameter('category', $searchOffer->getCategory());
        }
        if ($searchOffer->getMinPrice()) {
            $qb->andWhere('o.price > :minPrice')
                ->setParameter('minPrice', $searchOffer->getMinPrice());
        }
        if ($searchOffer->getMaxPrice()) {
            $qb->andWhere('o.price < :maxPrice')
                ->setParameter('maxPrice', $searchOffer->getMaxPrice());
        }
        $qb->orderBy('o.price', $searchOffer->getSortByPrice());

        return $qb->getQuery()
            ->getResult();
    }
}
