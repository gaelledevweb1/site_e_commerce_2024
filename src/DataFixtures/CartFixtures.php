<?php
 
namespace App\DataFixtures;

use App\Entity\Cart;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use App\DataFixtures\UserFixtures;

class CartFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $cart = new Cart();
            $cart->setArticleQuantity(mt_rand(1, 10));
            // $cart->setUser($this->getReference('user_' . rand(0, 50)));

            // relation one to one avec user
            $user = $this->getReference('user_' . $i);
            $cart->setUser($user);

            $manager->persist($cart);
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