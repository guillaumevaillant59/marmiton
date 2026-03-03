<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingredient;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setNom('Ingrédient ' . ($i + 1));
            $ingredient->setPrixAuKilo(mt_rand(1, 100) / 10);
            $ingredient->setDateCreation(new \DateTimeImmutable());

            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
