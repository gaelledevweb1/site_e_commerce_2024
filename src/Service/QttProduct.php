<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

// class QttProduct {
//      public $ArticleQuantit;
//      public $ArticleNam;
    


//      public function __construct(int $ArticleQuantit, string $ArticleNam  ) {
        
//         $this->ArticleQuantit = $ArticleQuantit;
//         $this->ArticleNam = $ArticleNam;
        
        

        
//     }

//     public function CreateProduct(int $ArticleQuantit, string $ArticleNam ) {
//         $this->ArticleQuantit = $ArticleQuantit;
//         $this->ArticleNam = $ArticleNam;
       
//     }

//     public function get_Product(){
//         return 
//         " ArticleQuantité: $this->ArticleQuantit
//         ArticleName:
//         $this->ArticleNam
//         ";
//     }
//     public function set_AddProduct($ArticleQuantit,$ArticleNam){
//         $this->ArticleQuantit = $ArticleQuantit;
//         $this->ArticleNam = $ArticleNam;
        
        
        
//     }

//     public function set_IncreaseProduct($ArticleQuantit,$ArticleNam){
//         $this->ArticleQuantit = $ArticleQuantit;
//         $this->ArticleNam = $ArticleNam;

        
//     }

//     public function delete($ArticleNam,$ArticleQuantit){
        
//         unset($ArticleQuantit); 
//        unset($ArticleNam);
        
//     }


// }
// $QttProduct1 = new QttProduct(2,'tapis',);
// $QttProduct1 -> CreateProduct(2,'tapis');
//  echo $QttProduct1 -> get_Product();


// $this->requestStack = $requestStack;

Class QttProduct {
    private $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    public function create(RequestStack $requestStack){
        $this->requestStack = $requestStack;
    }

     public function AddTocard(int $id){
        //  $request = $this->requestStack->getCurrentRequest();
        $requestcart = $this->requestStack->getSession()->get('cart',[]);
       if ( !empty($requestcart['$id'])) {
            $requestcart++;
        } else {
            $requestcart = 1;
        }  


        //  if ( !empty($cart)) {
        //      $cart++;
        //  } else {
        //      $cart = 1;
        //  }  
         $this->getSession()->set('cart',$requestcart);
        
     }
     public function getSession():SessionInterface{
        return $this->requestStack->getSession(); 
    }

    
    // public function getSession(): SessionInterface
    // {
        // if (( null !== $request = end($this->requests) ?: null) && $request->hasSession()) {
        //     return $request->getSession();
        // }

        // throw new SessionNotFoundException();

// condition1(->si ton panier n'est pas vide alors tu augmente de un sinon tu initialise à 1)
// et  condition2(->si la requete a une session)
// alors tu obtiendra l'objet SessionInterface de la requete actuelle
    
            // if ( !empty($cart)) {
            //     $cart++;
            // } else {
            //     $cart = 1;
            // }  
       
        
    //     if ($condition2) {
    //         $request->hasSession();
    //     }

    //     if($condition1 && $condition2){
    //         return $request->getSession();
    //     }

        

    // }
}
    

?>

