<?php

// namespace App\Controller;

// use App\Entity\Products;
// use App\Form\ProductsType;
// use App\Repository\ProductsRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

// #[Route('/admin/products')]
// class AdminProductsController extends AbstractController
// {
//     #[Route('/', name: 'app_admin_products_index', methods: ['GET'])]
//     public function index(ProductsRepository $productsRepository): Response
//     {
//         return $this->render('admin_products/index.html.twig', [
//             'products' => $productsRepository->findAll(),
//         ]);
//     }

//     #[Route('/new', name: 'app_admin_products_new', methods: ['GET', 'POST'])]
//     public function new(Request $request, EntityManagerInterface $entityManager): Response
//     {
//         $product = new Products();
//         $form = $this->createForm(ProductsType::class, $product);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $entityManager->persist($product);
//             $entityManager->flush();

//             return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
//         }

//         return $this->render('admin_products/new.html.twig', [
//             'product' => $product,
//             'form' => $form,
//         ]);
//     }

//     #[Route('/{id}', name: 'app_admin_products_show', methods: ['GET'])]
//     public function show(Products $product): Response
//     {
//         return $this->render('admin_products/show.html.twig', [
//             'product' => $product,
//         ]);
//     }

//     #[Route('/{id}/edit', name: 'app_admin_products_edit', methods: ['GET', 'POST'])]
//     public function edit(Request $request, Products $product, EntityManagerInterface $entityManager): Response
//     {
//         $form = $this->createForm(ProductsType::class, $product);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $entityManager->flush();

//             return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
//         }

//         return $this->render('admin_products/edit.html.twig', [
//             'product' => $product,
//             'form' => $form,
//         ]);
//     }

//     #[Route('/{id}', name: 'app_admin_products_delete', methods: ['POST'])]
//     public function delete(Request $request, Products $product, EntityManagerInterface $entityManager): Response
//     {
//         if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
//             $entityManager->remove($product);
//             $entityManager->flush();
//         }

//         return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
//     }
// }
