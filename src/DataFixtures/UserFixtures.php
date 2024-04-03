<?php
 
namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = [];

        // $product = new Product();
        // $manager->persist($product);

        for ($i=0; $i <=50 ; $i++) { 
        $user = new User();
        $user->setFirstName($faker->firstName());
        $user->setLastName($faker->lastName());
        // $user->setAddress($faker->streetAddress());
        // $user->setCity($faker->city());
        // $user->setZip($faker->postcode());
        // $user->setCountry($faker->country());
        $user->setPhone($faker->phoneNumber());
        $user->setBirthday($faker->dateTimeBetween('-80 years', '-18 years'));
        $user->setEmail($faker->email());
        $user->setPassword('password');
        
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $users[] = $user;
        // relation one to one avec cart
        $cart = $this->getReference('cart_' . $i);
        $user->setCart($cart);
        // relation one to one avec paiement
        // $paiement = $this->getReference('paiement_' . $i);
        // $user->setpaiement($paiement);

        // relation one to many avec order
        for ($j=0; $j < 10; $j++) { 
            $order = $this->getReference('order_' . $j);
            $user->addOrder($order);
        }
        // relation one to many avec articleBlog
        for ($k=0; $k < 10; $k++) { 
            $articleBlog = $this->getReference('articleBlog_' . $k);
            $user->addArticle($articleBlog);
        }
        // relation one to many avec commentsBlog
        for ($l=0; $l < 10; $l++) { 
            $commentsBlog = $this->getReference('commentsBlog_' . $l);
            $user->addCommentsBlog($commentsBlog);
        }

          $manager->persist($user);
        // $this->addReference('user_' . $i, $user);

           
        }

        

        $manager->flush();
        
    }

    // te permer de definir les groupes de fixtures qui sont en relation avec les autres fixtures et qui doivent etre chargé en meme temps
    public static function getGroups(): array
    {
        return ['CartFixtures', 'OrderFixtures', 'ArticleBlogFixtures', 'CommentsBlogFixtures'];
    }

    // Vous pouvez le faire en définissant l'ordre d'exécution des fixtures à l'aide de la méthode getDependencies :
public function getDependencies()
{
    return [
        OrderFixtures::class,
        CartFixtures::class,
        // PaiementFixtures::class,
        ArticleBlogFixtures::class,
        CommentsBlogFixtures::class

    ];
}

    
   
} 

?>