<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Products;
use App\Form\CartType;
use App\Repository\CartRepository;
use App\Repository\ProductsRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'app_cart_index', methods: ['GET'])]

    public function index(ProductsRepository $productsRepository, SessionInterface $session): Response
    {


        $products = $productsRepository->findAll();
        

        $cart = $session->get('cart', []);
        // dd($cart);
        // on initialise des variables
        $data = [];
        $total = 0;


        foreach ($cart as $id => $quantity) {
            $product = $productsRepository->find($id);

            $data[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
            $total += $product->getSellPriceHT() * $quantity;
        }

        // dd($data);
        // dd($total);

        return $this->render('cart/index.html.twig', [
            'products' => $products,
            'data' => $data,
            'total' => $total

        ]);
    }



    #[Route('/add/{id}', name: 'app_cart_add', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function new(RequestStack $requestStack, int $id, ProductsRepository $productsRepository, SessionInterface $session): Response
    {








        $product = $productsRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Le produit demandé n\'existe pas');
            return $this->redirectToRoute('app_cart_index');
        }


        // on recupère l'id du produit
        $id = $product->getId();

        // on recupère le panier existant
        $cart = $session->get('cart', []);

        // on ajoute le produit dans le panier s'il n'y est pas encore
        // sinon on incrémente sa quantité

        if (!isset($cart[$id])) {
            $cart[$id] = 1;
        } else {
            $cart[$id]++;
        }

        $session->set('cart', $cart);

        // on redirige vers la page du panier

        //  dd($product);
        return $this->redirectToRoute('app_cart_index', [
            'product' => $product,

        ]);
    }


    #[Route('/remove/{id}', name: 'app_cart_remove', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function remove(RequestStack $requestStack, int $id, ProductsRepository $productsRepository, SessionInterface $session): Response
    {

        $product = $productsRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Le produit demandé n\'existe pas');
            return $this->redirectToRoute('app_cart_index');
        }


        // on recupère l'id du produit
        $id = $product->getId();

        // on recupère le panier existant
        $cart = $session->get('cart', []);

        // on retire le produit du panier s'il n'y a qu'un exemplaire
        // sinon on décrémente sa quantité

        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }

        $session->set('cart', $cart);

        // on redirige vers la page du panier

        //  dd($product);
        return $this->redirectToRoute('app_cart_index', [
            'product' => $product,

        ]);
    }




    
    #[Route('/delete/{id}', name: 'app_cart_delete')]
    public function delete( SessionInterface $session, Products $product): Response

    {

        // on recupère l'id du produit
        $id = $product->getId();

        // on recupère le panier existant
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        // on redirige vers la page du panier




        return $this->redirectToRoute('app_cart_index');
    }


    #[Route('/empty', name: 'app_cart_empty')]
    public function empty(SessionInterface $session): Response
    {
        $session->remove('cart');
        return $this->redirectToRoute('app_cart_index');
    }
}
