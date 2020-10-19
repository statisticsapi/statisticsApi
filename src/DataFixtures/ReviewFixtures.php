<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ReviewFixtures extends Fixture
{
    public const NUMBER_OF_REVIEWS = 100000; // number of rows for reviews

    /**
     * @var Generator
     */
    private $faker;

    public function getDependencies(): array
    {
        return [
            HotelFixtures::class,
        ];
    }
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        $this->addReviews($manager,self::NUMBER_OF_REVIEWS);
        $manager->flush();
    }

    private function addReviews(ObjectManager $manager,$count)
    {
        for ($i = 0; $i < $count; ++$i) {
            $review = new Review();
            $comment = $this->faker->text;
            $score = $this->faker->numberBetween(0,5); // assumed score is from 0 to 5
            $review->setHotelId($this->faker->numberBetween(1,10)); // reviews assigned randomly to hotels
            $review->setComment($comment);
            $review->setScore($score);
            $review->setCreatedDate($this->faker->dateTimeBetween('-2 years','now'));// reviews distributed on last two years
            $manager->persist($review);
        };

    }
}
