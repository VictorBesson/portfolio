<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Project;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i <= 5; $i++) {

            $project = new Project();
            $project->setName($faker->words(2, true));
            $project->setDescription($faker->paragraph());
            $project->setLink($faker->url());
            $project->setLinkProject($faker->optional()->url());
            $manager->persist($project);
        }

        $manager->flush();
    }
}
