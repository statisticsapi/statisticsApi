<?php

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\ORM\EntityRepository;

/**
 * Class ReviewRepository
 * @package AppBundle\Repository
 */
final class ReviewRepository extends EntityRepository
{

    public function findByHotel(Hotel $hotel, $fromDate, $toDate,$groupBy)
    {
        try {
            return $this->createQueryBuilder('review')
                    ->select('AVG (review.score) as review_score','count(review.id) as review_count,'.$groupBy.'(review.createdDate) AS range')
                    ->where('review.createdDate Between :start and :end')
                    ->andwhere('review.hotelId = :hotelId')
                    ->setParameter('hotelId' , $hotel->getId())
                    ->setParameter('start' , $fromDate)
                    ->setParameter('end' , $toDate)
                    ->groupBy('range')
                    ->getQuery()
                    ->getResult();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}
