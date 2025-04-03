<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale:'fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post
                ->setTitle($faker->realTextBetween($minNbChars = 20, $maxNbChars = 50))
                ->setContent($faker->name)
                ->setAuthor($faker->realText())
                ->setPublished(
                    \DateTimeImmutable::createFromMutable(
                        $faker->dateTimeBetween(startDate: '-20 days', endDate: '+30 days'))
                    );
            $manager
                ->persist($post);//prend en compte l'entité écrite juste au-dessus
        }

        $manager
            ->flush();//maj bdd
    }
}