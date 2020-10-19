<?php

namespace App\Service;

use App\Entity\Hotel;
use App\Entity\Review;
use DateInterval;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ReviewService
 * @package App\Service
 */
class ReviewService
{
    const DAILY_BOUNDARY = 29;
    const WEEKLY_BOUNDARY = 89;
    const MONTHLY_BOUNDARY = 89;

    /**
     * @var EntityManagerInterface
     */
    private  $entityManager;

    /**
     * ReviewService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param  Hotel  $hotel
     * @return array
     * @throws \Exception
     */
    public function groupByInterval(Hotel $hotel, $fromDate, $toDate): array
    {
        try {
        $diff = (new \DateTime($fromDate))->diff(new \DateTime($toDate));
        $groupBy = (function(DateInterval $diff): string {
            $diffInDays = $diff->days;
            if($diffInDays != null)
            {
                if($diffInDays <= self::DAILY_BOUNDARY) { return 'day'; };
                if($diffInDays <= self::WEEKLY_BOUNDARY) { return 'week'; };
                if($diffInDays > self::MONTHLY_BOUNDARY) { return 'month'; };
            }
        })($diff);

        return $this->entityManager->getRepository(Review::class)->findByHotel($hotel, $fromDate, $toDate, $groupBy);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
