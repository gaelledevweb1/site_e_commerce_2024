<?php
namespace App\Service;

use App\Repository\ProductsRepository;
use App\Entity\Order;
use App\Entity\RecapDetails;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

 use Symfony\Component\HttpFoundation\RequestStack;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class VerificationCommandeService
{
    private $productsRepository;
    private $entityManager;

    private $authorizationChecker;
    // private $session;
    private $requestStack;
    

    public function __construct(ProductsRepository $productsRepository, EntityManagerInterface $entityManager, AuthorizationCheckerInterface $authorizationChecker, RequestStack $requestStack)
    {
        $this->productsRepository = $productsRepository;
        $this->entityManager = $entityManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->requestStack = $requestStack;
    }

    public function prepareOrder($user, $adressDelivery)
    {
        // Déplacez ici la logique de préparation de la commande

        if (false === $this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException($user);
        }
        

        
            //  je recupere adressDelivery dans la session et j'incorpore le reste des données

         $adressDelivery = $this->requestStack->getSession()->get('adressDelivery');

        //  dump($adressDelivery);

         if ($adressDelivery === null) {
            // Handle the case where adressDelivery is not set in the session
            throw new \Exception('adressDelivery is not set in the session');
        }

        $this->requestStack->getSession()->set('firstName', $adressDelivery->getFirstName());
         $this->requestStack->getSession()->set('lastName', $adressDelivery->getLastName());
         $this->requestStack->getSession()->set('phone', $adressDelivery->getPhone());
         $this->requestStack->getSession()->set('number', $adressDelivery->getNumber());
         $this->requestStack->getSession()->set('street', $adressDelivery->getStreet());
         $this->requestStack->getSession()->set('zip', $adressDelivery->getZip());
         $this->requestStack->getSession()->set('city', $adressDelivery->getCity());
         $this->requestStack->getSession()->set('country', $adressDelivery->getCountry());
       
         return $adressDelivery;
            
        

    }

        //  je creer une  fonction pour prendre en charge createRecapDetails($order)

        public function createRecapDetails($order)
        {
           
            $cart =  $this->requestStack->getSession()->get('cart', []);
    
            foreach ($cart as $id => $quantity) {
                $product = $this->productsRepository->find($id);
    
                if ($product) {
                    $recapDetails = new RecapDetails();
                    $recapDetails->setorderProduct($order);
                    $recapDetails->setQuantity($quantity);
                    $recapDetails->setPrice($product->getSellPriceHT());
                    $recapDetails->setProduct($product->getArticleName());
                    $recapDetails->setTotalRecap($product->getSellPriceHT() * $quantity);

                    // Ajouter RecapDetails à la collection recapDetails de Order
                    $order->addRecapDetail($recapDetails);
    
                    $this->entityManager->persist($recapDetails);
                    $this->entityManager->persist($order);
                }
            }
            $this->entityManager->flush();

        }

       
public function createOrder($user, $adressDelivery, $datetime)
{

    $order = new Order();
    $order->setUser($user);
    $order->setOrderDate($datetime);
    $order->setPaid(false);
    $order->setStatus('En attente de paiement');
    $order->setDelivered(false);
    $order->setDeliveryDate($datetime);
    $order->setDeliveryInfo('En attente de livraison');
    $order->setReference($datetime->format(format: 'dmY') . '-' . uniqid());
    
    // $order->setTransporterName($transporter->getTitle());
    //  dd($transporter);
    // $order->setTransporterPrice($transporter->getPrice());
    // $order->setTransporterContent($transporter->getContent());
    // $order->setAdress($adressDelivery);
    $order->setMethod(" stripe");

    
    $this->entityManager->persist($order);
    $this->entityManager->flush();


    return $order;

    
}


    }

    
    
    
            
            
    
           
           


    

?>