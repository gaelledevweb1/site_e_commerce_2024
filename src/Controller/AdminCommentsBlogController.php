<?php

namespace App\Controller;

use App\Entity\CommentsBlog;
use App\Form\CommentsBlogType;
use App\Repository\CommentsBlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/comments/blog')]
class AdminCommentsBlogController extends AbstractController
{
    #[Route('/', name: 'app_admin_comments_blog_index', methods: ['GET'])]
    public function index(CommentsBlogRepository $commentsBlogRepository): Response
    {
        return $this->render('admin_comments_blog/index.html.twig', [
            'comments_blogs' => $commentsBlogRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_comments_blog_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentsBlog = new CommentsBlog();
        $form = $this->createForm(CommentsBlogType::class, $commentsBlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentsBlog);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_comments_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_comments_blog/new.html.twig', [
            'comments_blog' => $commentsBlog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_comments_blog_show', methods: ['GET'])]
    public function show(CommentsBlog $commentsBlog): Response
    {
        return $this->render('admin_comments_blog/show.html.twig', [
            'comments_blog' => $commentsBlog,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_comments_blog_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommentsBlog $commentsBlog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentsBlogType::class, $commentsBlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_comments_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_comments_blog/edit.html.twig', [
            'comments_blog' => $commentsBlog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_comments_blog_delete', methods: ['POST'])]
    public function delete(Request $request, CommentsBlog $commentsBlog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentsBlog->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commentsBlog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_comments_blog_index', [], Response::HTTP_SEE_OTHER);
    }
}
