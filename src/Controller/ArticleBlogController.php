<?php

namespace App\Controller;

use App\Entity\ArticleBlog;
use App\Form\ArticleBlog1Type;
use App\Repository\ArticleBlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article/blog')]
class ArticleBlogController extends AbstractController
{
    #[Route('/', name: 'app_article_blog_index', methods: ['GET'])]
    public function index(ArticleBlogRepository $articleBlogRepository): Response
    {
        return $this->render('article_blog/index.html.twig', [
            'article_blogs' => $articleBlogRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_article_blog_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $articleBlog = new ArticleBlog();
        $form = $this->createForm(ArticleBlog1Type::class, $articleBlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($articleBlog);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article_blog/new.html.twig', [
            'article_blog' => $articleBlog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_blog_show', methods: ['GET'])]
    public function show(ArticleBlog $articleBlog): Response
    {
        return $this->render('article_blog/show.html.twig', [
            'article_blog' => $articleBlog,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_article_blog_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArticleBlog $articleBlog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticleBlog1Type::class, $articleBlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_article_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article_blog/edit.html.twig', [
            'article_blog' => $articleBlog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_blog_delete', methods: ['POST'])]
    public function delete(Request $request, ArticleBlog $articleBlog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleBlog->getId(), $request->request->get('_token'))) {
            $entityManager->remove($articleBlog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_article_blog_index', [], Response::HTTP_SEE_OTHER);
    }
}
