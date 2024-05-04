<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Form\CartType;
use App\Repository\CartRepository;
use App\Repository\ProductsRepository;
use App\Service\QttProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'app_cart_index', methods: ['GET'])]
    // public function index(CartRepository $cartRepository, ProductsRepository $productsRepository): Response
    // {
    //     $carts = $cartRepository->findAll();
    //     $products= $productsRepository->findAll();
    //     return $this->render('cart/index.html.twig', [
    //         'carts' => $carts,
    //         'products' => $products ,
            
    //     ]);
    // }
    public function index(ProductsRepository $productsRepository): Response{
       
        $products= $productsRepository->findAll();
        return $this->render('cart/index.html.twig', [
            'products' => $products ,
            
        ]);
    }

    #[Route('/add/{id}', name: 'app_cart_add', methods: ['GET', 'POST'],requirements: ['id' => '\d+'])]
    public function new(RequestStack $requestStack,QttProduct $qttProduct,int $id): Response
    {
        $cart = $qttProduct->AddTocard( $id);
         dd($qttProduct);
       

           
        

        return $this->redirectToRoute('app_cart_index', [
            'cart' => $cart,
            
        ]);
    }

    #[Route('/{id}', name: 'app_cart_show', methods: ['GET'])]
    public function show(Cart $cart): Response
    {
        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cart_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cart/edit.html.twig', [
            'cart' => $cart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cart_delete', methods: ['POST'])]
    public function delete(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
    }
}
