<?php
 
namespace App\DataFixtures;

use App\Entity\CommentsBlog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker;
use App\DataFixtures\UserFixtures;

class CommentsBlogFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($l = 0; $l < 10; $l++) {
            $commentsBlog = new CommentsBlog();
            $commentsBlog->setComments($faker->text());
            $commentsBlog->setAuthor($faker->name());
            $commentsBlog->setDateCreation($faker->dateTimeThisYear());
            // $commentsBlog->setUser($this->getReference('user_' . rand(0, 50)));


            $manager->persist($commentsBlog);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['ArticleBlogFixtures', 'UserFixtures'];
    }

    // Vous pouvez le faire en définissant l'ordre d'exécution des fixtures à l'aide de la méthode getDependencies :
public function getDependencies()
{
    return [
        UserFixtures::class,
        ArticleBlogFixtures::class
    ];
}

} 
?>