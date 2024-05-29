<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductsRepository $productsRepository): Response
    {
        // $products = $productsRepository->findAll();
        // Récupère les produits et les trie par le nombre de ventes en ordre décroissant, puis on prend les 3 premiers
     $products = $productsRepository->findBy([], ['sales' => 'DESC'],3);

    return $this->render('home/index.html.twig', [
         'products' => $products,
    ]);
    }

   

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
