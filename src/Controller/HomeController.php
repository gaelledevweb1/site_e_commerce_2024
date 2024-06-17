<?php

namespace App\Controller;

use App\Entity\CoursGymnastiqueDouceSenior;
use App\Entity\Inscription;
use App\Entity\Products;
use App\Form\InscriptionType;
use App\Repository\CoursGymnastiqueDouceSeniorRepository;
use App\Repository\InscriptionRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Renders the home page.
     *
     * @param ProductsRepository $productsRepository The repository for Products entity.
     * @return Response The response object.
     */
    #[Route('/', name: 'app_home')]
    public function index(ProductsRepository $productsRepository): Response
    {
        // $products = $productsRepository->findAll();
        // Récupère les produits et les trie par le nombre de ventes en ordre décroissant, puis on prend les 3 premiers
        $products = $productsRepository->findBy([], ['sales' => 'DESC'], 3);

        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * Renders the about page.
     *
     * @return Response The response object.
     */
    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the contact page.
     *
     * @return Response The response object.
     */
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the Cours Seniors page.
     *
     * @param CoursGymnastiqueDouceSeniorRepository $CoursGymnastiqueDouceSeniorRepository The repository for CoursGymnastiqueDouceSenior entity.
     * @return Response The response object.
     */
    #[Route('/cours-seniors', name: 'app_cours_seniors')]
    public function CoursSeniors(CoursGymnastiqueDouceSeniorRepository $CoursGymnastiqueDouceSeniorRepository): Response
    {
        $CoursGymnastiqueDouceSenior = $CoursGymnastiqueDouceSeniorRepository->findALL();
        //  dd($CoursGymnastiqueDouceSenior);

        return $this->render('home/cours-Seniors.html.twig', [
            'CoursGymnastiqueDouceSenior' => $CoursGymnastiqueDouceSenior,
        ]);
    }

    /**
     * Renders the CGU page.
     *
     * @return Response The response object.
     */
    #[Route('/cgu', name: 'app_CGU')]
    public function CGU(): Response
    {
        return $this->render('home/CGU.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the CGV page.
     *
     * @return Response The response object.
     */
    #[Route('/CGV', name: 'app_CGV')]
    public function CGV(): Response
    {
        return $this->render('home/CGV.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the mention légale page.
     *
     * @return Response The response object.
     */
    #[Route('/mentionLegale', name: 'app_mentionLegale')]
    public function mentionLegale(): Response
    {
        return $this->render('home/mentionLegale.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the politique de cookie page.
     *
     * @return Response The response object.
     */
    #[Route('/polithiqueCookie', name: 'app_polithiqueCookie')]
    public function polithiqueCookie(): Response
    {
        return $this->render('home/polithiqueCookie.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the FAQ page.
     *
     * @return Response The response object.
     */
    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('home/faq.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the information livraison page.
     *
     * @return Response The response object.
     */
    #[Route('/information_livraison', name: 'app_livraison')]
    public function livraison(): Response
    {
        return $this->render('home/livraison.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Renders the information retour échange page.
     *
     * @return Response The response object.
     */
    #[Route('/information_retour_echange', name: 'app_retourEchange')]
    public function retourEchange(): Response
    {
        return $this->render('home/retourEchange.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
