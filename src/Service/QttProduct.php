<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class QttProduct {
    public $ArticleQuantit;
    public $ArticleNam;
    


     public function __construct(int $ArticleQuantit, string $ArticleNam  ) {
        
        $this->ArticleQuantit = $ArticleQuantit;
        $this->ArticleNam = $ArticleNam;
        // $this->requestStack = $requestStack;
        
    }

    public function CreateProduct(int $ArticleQuantit, string $ArticleNam ) {
        $this->ArticleQuantit = $ArticleQuantit;
        $this->ArticleNam = $ArticleNam;
    }

    public function get_Product(){
        return 
        " ArticleQuantité: $this->ArticleQuantit
        ArticleName:
        $this->ArticleNam
        ";
    }
    public function set_AddProduct($ArticleQuantit,$ArticleNam){
        $this->ArticleQuantit = $ArticleQuantit;
        $this->ArticleNam = $ArticleNam;
        //  je souhaite pouvoir incrementer
        
        
    }

    public function set_IncreaseProduct($ArticleQuantit,$ArticleNam){
        $this->ArticleQuantit = $ArticleQuantit;
        $this->ArticleNam = $ArticleNam;

        // je souhaite décrémenter
    }

    public function delete($ArticleNam,$ArticleQuantit){
        
        unset($ArticleQuantit); 
       unset($ArticleNam);
        
    }


}
$QttProduct1 = new QttProduct(2,'tapis',);
$QttProduct1 -> CreateProduct(2,'tapis');
 echo $QttProduct1 -> get_Product();




?>