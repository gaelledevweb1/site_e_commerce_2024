<?php
 
namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker;

class ProductsFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $products = [];

        for ($i=0; $i <=50 ; $i++) { 
            $product = new Products();
            $product->setArticleRef($faker->ean13());
            $product->setArticleName($faker->word());
            $product->setArticleImages($faker->imageUrl());
            $product->setArticleThumbnails($faker->imageUrl());
            $product->setArticleStockQuantity($faker->numberBetween(1, 100));
            $product->setArticleDescription($faker->text());
            $product->setBoughtPrice($faker->randomFloat(2, 1, 100));
            $product->setSellPriceHT($faker->randomFloat(2, 1, 100));
            $product->setSellPriceTTC($faker->randomFloat(2, 1, 100));
            $product->setTVA($faker->randomFloat(2, 1, 100));
            $product->setDetails($faker->text());
            $manager->persist($product);
            $products[] = $product;
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['CategoriesBlogFixtures', 'CategoryFixtures'];
    }

    // Vous pouvez le faire en définissant l'ordre d'exécution des fixtures à l'aide de la méthode getDependencies :
public function getDependencies()
{
    return [
        CategoriesBlogFixtures::class,
        CategoryFixtures::class

    ];
}
} 

?>