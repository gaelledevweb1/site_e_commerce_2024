<?php
  
namespace App\DataFixtures;

use App\Entity\CategoriesBlog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker;
use App\DataFixtures\ArticleBlogFixtures;

class CategoriesBlogFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $categoriesBlog = new CategoriesBlog();
            $categoriesBlog->setNameCategory($faker->word());
            // $categoriesBlog->setCategoriesBlog($this->getReference('categoriesBlog_' . rand(0, 10)));

            // relation one to many avec  articleBlog
            for ($m = 0; $m < 10; $m++) {
                $articleBlog = $this->getReference('articleBlog_' . $m);
                $categoriesBlog->addArticleBlog($articleBlog);
            }
        

            $manager->persist($categoriesBlog);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['ArticleBlogFixtures'];
    }

    // Vous pouvez le faire en définissant l'ordre d'exécution des fixtures à l'aide de la méthode getDependencies :
    public function getDependencies()
    {
        return [
            ArticleBlogFixtures::class,
        ];
    }
}  
?>