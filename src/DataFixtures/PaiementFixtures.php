<?php
 
namespace App\DataFixtures;

use App\Entity\Paiement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;

class PaiementFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $paiements = [];

        for ($i=0; $i <=50 ; $i++) { 
            $paiement = new Paiement();
            $paiement->setBankName($faker->word());
            $paiement->setCardName($faker->word());
            $paiement->setCardNumber($faker->creditCardNumber());
            $paiement->setCardNetwork($faker->creditCardType());
            $paiement->setCardHoldername($faker->name());
            $paiement->setExpirationDate($faker->dateTime());
            $paiement->setCVCCode($faker->numberBetween(100, 999));
            $paiement->setSecurityCard($faker->word());
            $paiement->setCurrency($faker->currencyCode());



            $manager->persist($paiement);
            $paiements[] = $paiement;
        }

        $manager->flush();
    }

    
   
} 

?>