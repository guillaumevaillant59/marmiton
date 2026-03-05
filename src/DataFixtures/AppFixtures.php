<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingredient;
use App\Entity\User;
use App\Entity\Recipe;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setNom("Ingredient " . ($i + 1));
            $ingredient->setPrixAuKilo(mt_rand(1, 100) / 10);
            $ingredient->setDateCreation(new \DateTimeImmutable());

            $manager->persist($ingredient);
        }
        
        for($j=0; $j<20; $j++) {
            $recipe = new Recipe();
            $recipe->setName("Recette " . ($j + 1));
            $recipe->setTime(mt_rand(1, 1140));
            $recipe->setNbPeople(mt_rand(0, 1)==1 ? mt_rand(1, 50) : null);
            $recipe->setDifficulty(mt_rand(0, 1)==1 ? mt_rand(1, 5) : null);   
            $recipe->setDescription("Description " . ($j + 1));
            $recipe->setPrice(mt_rand(0, 1000) / 10);
            $recipe->setCreateAt(new \DateTimeImmutable());
            $recipe->setUpdateAt(new \DateTimeImmutable());
            $recipe->setIsFavorite(mt_rand(0, 1)==1 ? true : false);

            for($k=0; $k<mt_rand(5, 15); $k++) {
                $recipe->addIngredient($ingredient[mt_rand(0, count($ingredient) - 1)]);
            }

            $manager->persist($recipe);
        }


        for($l=0; $l<5; $l++) {
            $user = new User();
            $user->setEmail('user' . ($l + 1) . '@example.com');
            $user->setPassword($this->passwordHasher->hashPassword($user, 'mdp'));
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
