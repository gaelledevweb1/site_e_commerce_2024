<?php

namespace App\Controller;

use App\Entity\CategoriesBlog;
use App\Form\CategoriesBlog1Type;
use App\Repository\CategoriesBlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories/blog')]
class CategoriesBlogController extends AbstractController
{
    #[Route('/', name: 'app_categories_blog_index', methods: ['GET'])]
    public function index(CategoriesBlogRepository $categoriesBlogRepository): Response
    {
        return $this->render('categories_blog/index.html.twig', [
            'categories_blogs' => $categoriesBlogRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categories_blog_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoriesBlog = new CategoriesBlog();
        $form = $this->createForm(CategoriesBlog1Type::class, $categoriesBlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoriesBlog);
            $entityManager->flush();

            return $this->redirectToRoute('app_categories_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categories_blog/new.html.twig', [
            'categories_blog' => $categoriesBlog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categories_blog_show', methods: ['GET'])]
    public function show(CategoriesBlog $categoriesBlog): Response
    {
        return $this->render('categories_blog/show.html.twig', [
            'categories_blog' => $categoriesBlog,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categories_blog_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoriesBlog $categoriesBlog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriesBlog1Type::class, $categoriesBlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categories_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categories_blog/edit.html.twig', [
            'categories_blog' => $categoriesBlog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categories_blog_delete', methods: ['POST'])]
    public function delete(Request $request, CategoriesBlog $categoriesBlog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriesBlog->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoriesBlog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categories_blog_index', [], Response::HTTP_SEE_OTHER);
    }
}
