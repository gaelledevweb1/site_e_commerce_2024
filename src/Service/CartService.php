<?php

// namespace App\Service;

// use App\Entity\Products;
// use Doctrine\ORM\EntityManager;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
// use Symfony\Component\HttpFoundation\RequestStack;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;



// class CartService{


//     private RequestStack  $requestStack;
//     private EntityManagerInterface $em;

//     public function __construct(RequestStack $requestStack,EntityManagerInterface $em)
//     {
//         $this->requestStack = $requestStack;
//         $this -> em = $em;


//     }

//     public function addToCart(int $id) : void{
//         $cart = $this -> requestStack -> getSession() -> get('cart',[]);
        
//         if(!empty($cart[$id])){
//             $cart[$id]++;
//         }else{
//             $cart[$id] = 1;
//         }
//            dump($cart);
//         $this -> getSession() ->set('cart',$cart);

//     }


//     public function getTotal()
//     {
//         $cart = $this -> getsession()-> get ('cart');
//         if ($cart === null) {
//             $cart = [];
//         }
//         $cartData = [];
//         foreach ($cart as $id => $quantity){
//             $product = $this -> em -> getRepository(Products::class) -> findOneBy(['id'=>$id]);
//             if(!$product){
//                 //  supprimer le produit puis continue en sortant de la boucle 
//             }
//             $cartData[]= [
//                 'product'=> $product,
//                 'quantity'=> $quantity
//             ];
//         }
//         return $cartData;
//     }

//     private function getSession():SessionInterface
//     {
//         return $this -> requestStack -> getSession();
//     }

// }