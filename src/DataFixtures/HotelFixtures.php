<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class HotelFixtures extends AppFixtures
{
    public const NUMBER_OF_HOTELS = 10; //number of rows for hotels
    /**
     * @var Generator
     */
    private $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        $this->addHotels($manager,self::NUMBER_OF_HOTELS);
        $manager->flush();

    }

    private function addHotels(ObjectManager $manager,$count)
    {
        for ($i = 1; $i <= $count; $i++) {
            $hotel = new Hotel();
            $name = $this->faker->company;
            $hotel->setName($name);

            $manager->persist($hotel);

        }
    }


}
