<?php

namespace App\Controller;

use App\Serializer\DataSerializer;
use App\Serializer\ReviewCriteria;
use App\Entity\Hotel;
use App\Service\ReviewService;
use AppBundle\Api\V2\Criteria\OrdersCriteria;
use AppBundle\Api\V2\Response\OrdersResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CustomerSiteController
 * @package App\Controller
 *
 * @Route(path="/reviews")
 */
class ReviewController
{
    public const HTTP_STATUS_OK = 200;
    public const HTTP_STATUS_NOT_FOUND = 404;

    /**
     * @var ReviewService
     */
    private  $reviewService;

    /**
     * @var EntityManagerInterface
     */
    private  $entityManager;

    /**
     * ReviewController constructor.
     * @param EntityManagerInterface $entityManager
     * @param ReviewService $reviewService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ReviewService $reviewService
    ) {
        $this->entityManager = $entityManager;
        $this->reviewService = $reviewService;
    }

    /**
     * @Route("/get/{id}", name="hotel-review", methods={"GET"})
     * @param  int  $id
     * @param  Request  $request
     * @param  ValidatorInterface  $validator
     * @return JsonResponse
     * @throws \Exception
     */
    public function get( int $id,Request $request,ValidatorInterface $validator) :JsonResponse
    {
        // check if hotel exists
        $hotel = $this->entityManager->getRepository(Hotel::class)->find($id);

         if(!$hotel)
         {
             $response =[
                   'code' => HTTP_STATUS_NOT_FOUND,
                   'message' => 'Hotel not found'
             ];

             return new JsonResponse($response, HTTP_STATUS_NOT_FOUND, [], false);
         }
        // validate input dates have valid date format
        $fromDate = $request->query->get('date_from');
        $toDate = $request->query->get('date_to');
        $input = ['fromDate' => $fromDate, 'toDate' => $toDate];

        $constraints = new Assert\Collection([
            'fromDate' => [new Assert\Date(), new Assert\NotBlank],
            'toDate' => [new Assert\Date(), new Assert\notBlank],
        ]);

        $violations = $validator->validate($input, $constraints);

        // Return validation errors
        if (count($violations) > 0) {

            $response = [];

            foreach ($violations as $violation) {
                $response[] =
                    [
                        $violation->getPropertyPath() => $violation->getMessage()
                    ];
            }

            return new JsonResponse($response, 400, [], false);
        }

        // Process
        $result = $this->reviewService->groupByInterval($hotel,$fromDate,$toDate);

        $response =[
            'code' => self::HTTP_STATUS_OK,
            'data' => $result
        ];

        return new JsonResponse($response, self::HTTP_STATUS_OK, [], false);

    }
}