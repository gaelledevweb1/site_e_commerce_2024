<?php





// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Adress;
use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Paiement;
use App\Entity\Products;
use Faker\Factory as Faker;
use Bluemmb\Faker\PicsumPhotosProvider;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {


        // creation de l'utilisateur :
        $user = new User();
        $user->setFirstName('Luna');
        $user->setLastName('Doe');
        $user->setPhone('123456789');
        // $user->setBirthday(new \DateTime('1980-01-01'));
        $user->setEmail('Luna@gmail.com');
        $user->setPassword($this->hasher->hashPassword(
            $user,
            'Luna1234/'
        ));
        $user->setRoles(['ROLE_User']);
        $user->setIsVerified(true);
        $user->setCreatedAtValue(new \DateTimeImmutable('2022-04-01 12:00:00'));
        $user->setUpdateAtValue(new \DateTimeImmutable('now'));
        // $cart = $this->getReference('cart');

        // $user->setCart($cart);

        $users[] = $user;
        $manager->persist($user);
        // Store a reference to the category for later use
        $this->addReference('user-0', $user);

        // creation du Panier :

        $cart = new Cart();
        $cart->setArticleQuantity(2);

        // Assignation du panier à l'utilisateur :
        $user->setCart($cart);
        $manager->persist($cart);

        $this->addReference('cart', $cart);

        $manager->flush();

        $admin = new User();
        $admin->setFirstName('admin');
        $admin->setLastName('magdalina');
        $admin->setPhone('123457789');
        // $admin->setBirthday(new \DateTime('1984-05-01'));

        $admin->setEmail('magdelina@gmail.com');
        $password = $this->hasher->hashPassword($admin, 'pass_1234');
        $admin->setPassword($password);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsVerified(true);
        $admin->setCreatedAtValue(new \DateTimeImmutable('2022-04-01 12:00:00'));
        $admin->setUpdateAtValue(new \DateTimeImmutable('now'));

        $users[] = $admin;
        $manager->persist($admin);
        // Store a reference to the cart and category and Adress for later use
        $this->addReference('user-1', $admin);
        $manager->flush();


        // creation de l'Adresse:
        $adress = new Adress();
        $adress->setCity('Paris');
        $adress->setZip(75000);
        $adress->setCountry('France');
        $adress->setNumber(12);
        $adress->setStreet('rue de la paix');

        // Get a  user and assign it to the Adress
        $user = $this->getReference('user-' . rand(0, 1));
        $adress->setUser($user);


        $manager->persist($adress);

        $manager->flush();

        // creation de category :

        $faker = Faker::create();
        $faker->addProvider(new PicsumPhotosProvider($faker));


        $category = new Category();
        $category->setNameCategory('Electronics');
        $category->setCategoryImages($faker->imageUrl(200,200, true));
        $manager->persist($category);
        $this->addReference('category-0', $category);

        $manager->flush();


        // creation de produits :
        $products = [];
        for ($i = 0; $i < 10; $i++){
            $product = new Products();
            $product->setArticleRef($faker->NumberBetween(1,6000));
            $product->setArticleName($faker->words (3, true));
            $product->setArticleImages($faker->imageUrl(300, true));
            $product->setArticleThumbnails($faker->imageUrl(150, true));
            $product->setArticleStockQuantity($faker->randomDigit());
            $product->setArticleDescription($faker->sentence(10));
            $product->setBoughtPrice($faker->randomFloat(2, 0, 1000));
            $product->setSellPriceHT($faker->randomFloat(2, 0, 1000));
            $product->setSellPriceTTC($faker->randomFloat(2, 0, 1000));
            $product->setTVA(20);
            $product->setDetails($faker->sentence(5));
            $product->setSales($faker->randomDigit());
            $product->setCategory($category);
            $products[] = $product;
            $manager->persist($product);
            $this->addReference('product-'.$i, $product);
    
           
        }

        $manager->flush();

        // creation de paiement : 
        $payments = [];
        for ($i = 0; $i < 10; $i++){
           
            $payment = new Paiement();
        $payment->setBankName($faker->company());
        $payment->setCardName($faker->name());
        $payment->setCardNumber($faker->creditCardNumber());
        $payment->setCardNetwork($faker->creditCardType());
        $payment->setCardHoldername($faker->name());
        $payment->setExpirationDate($faker->creditCardExpirationDate());
        $payment->setCVCCode($faker->numberBetween(100,999));
        $payment->setSecurityCard($faker->creditCardNumber());
        $payment->setCurrency('EUR');
        $payments = $payment;
        $manager->persist($payment);
        

        $this->addReference('payment-'.$i, $payment);
           
        }
        

        $manager->flush();

        // creation de la commande :
        

        $order = new Order();
        $order->setOrderDate(new \DateTime('2021-10-10'));
        $order->setPaid(true);
        $order->setStatus('En cours de traitement');
        $order->setDelivered(false);
        $order->setDeliveryDate(new \DateTime('2021-10-15'));
        
        $order->setDeliveryInfo('Livraison à domicile');
        
       
        $user = $this->getReference('user-' . rand(0, 1));
        $order->setUser($user);
       
        $manager->persist($order);
        $this->addReference('order-0', $order);

        $manager->flush();
    }


}
