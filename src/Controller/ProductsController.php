<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\QttProduct;

/**
 * Controller class for managing products.
 */
#[Route('/products')]
class ProductsController extends AbstractController
{
    /**
     * Displays a list of all products.
     *
     * @param ProductsRepository $productsRepository The repository for products.
     * @return Response The response object.
     */
    #[Route('/', name: 'app_products_index', methods: ['GET'])]
    public function index(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findAll();
        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * Displays the details of a specific product.
     *
     * @param Products $product The product entity.
     * @return Response The response object.
     */
    #[Route('/{id}', name: 'app_products_show', methods: ['GET'])]
    public function show(Products $product): Response
    {
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }
}
