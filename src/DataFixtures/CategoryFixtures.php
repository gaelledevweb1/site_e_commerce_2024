<?php
  
namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setNameCategory($faker->word());
            $category->setCategoryImages($faker->imageUrl());

             // relation one to many avec products
                for ($e = 0; $e < 50; $e++) {
                    $product = $this->getReference('product_' . $e);
                    $category->addProduct($product);
                }

            $manager->persist($category);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['ProductsFixtures'];
    }

    // Vous pouvez le faire en définissant l'ordre d'exécution des fixtures à l'aide de la méthode getDependencies :
public function getDependencies()
{
    return [
        ProductsFixtures::class,
        

    ];
}
}  
?>