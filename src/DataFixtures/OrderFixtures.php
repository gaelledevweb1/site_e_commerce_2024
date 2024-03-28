<?php
 
namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker;
use App\DataFixtures\UserFixtures;

class OrderFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($j = 0; $j < 10; $j++) {
            $order = new Order();
            $order->setOrderDate($faker->dateTimeThisYear());
            $order->setPaid($faker->boolean());
            $order->setStatus($faker->word());
            $order->setDelivered($faker->boolean());
            $order->setDeliveryDate($faker->dateTimeThisYear());
            $order->setDeliveryInfo($faker->text());
            $order->setUser($this->getReference('user_' . rand(0, 50)));

            

            $manager->persist($order);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['UserFixtures'];
    }

    // Vous pouvez le faire en définissant l'ordre d'exécution des fixtures à l'aide de la méthode getDependencies :
public function getDependencies()
{
    return [
        UserFixtures::class,
    ];
}

} 

?>