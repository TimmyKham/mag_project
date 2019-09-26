<?php

namespace App\DataFixtures;

use App\Entity\Magazines;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class MagazinesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i<50; $i++){
            $magazines = new Magazines();
            $magazines
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3,true))
                ->setSeller($faker->company)
                ->setCategory($faker->company)
                ->setPrice($faker->numberBetween(1,20));
            $manager->persist($magazines);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
