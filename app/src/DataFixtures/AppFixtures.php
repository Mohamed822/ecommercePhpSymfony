<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load($manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
