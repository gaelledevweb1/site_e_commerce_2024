<?php

namespace App\DataFixtures;

use App\Entity\ArticleBlog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\CategoriesBlogFixtures;
use App\DataFixtures\CommentsBlogFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleBlogFixtures extends Fixture implements FixtureGroupInterface 
{
     
    public function load(ObjectManager $manager)
    { 
        $faker = Faker\Factory::create('fr_FR');
        
        for ($k = 0; $k < 10; $k++) {
            $articleBlog = new ArticleBlog();
            $articleBlog->setTitle($faker->sentence());
            $articleBlog->setContain($faker->paragraph());
            $articleBlog->setAuthor($faker->name());
            $articleBlog->setDateCreation($faker->dateTimeBetween('-6 months'));
            $articleBlog->setUser($this->getReference('user_' . rand(0, 50)));
            $articleBlog->setCategoriesBlog($this->getReference('categoriesBlog_' . rand(0, 9)));
            $articleBlog->addCommentsBlog($this->getReference('commentsBlog_' . rand(0, 50))); 

            // relation one to many avec commentsBlog
        for ($l=0; $l < 10; $l++) { 
            $commentsBlog = $this->getReference('commentsBlog_' . $l);
            $articleBlog->addCommentsBlog($commentsBlog);
        }

        
            
            $manager->persist($articleBlog);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['UserFixtures','CategoriesBlogFixtures','CommentsBlogFixtures'];
    }
    // Vous pouvez le faire en définissant l'ordre d'exécution des fixtures à l'aide de la méthode getDependencies :
public function getDependencies()
{
    return [
        UserFixtures::class,
        CategoriesBlogFixtures::class,
        CommentsBlogFixtures::class,
    ];
    
}

}  


?> 

