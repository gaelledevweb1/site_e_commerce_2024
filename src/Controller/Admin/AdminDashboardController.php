<?php

namespace App\Controller\Admin;

use App\Entity\Adress;
use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\CoursGymnastiqueDouceSenior;
use App\Entity\Inscription;
use App\Entity\Order;
use App\Entity\Paiement;
use App\Entity\Products;
use App\Entity\RecapDetails;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminDashboardController extends AbstractDashboardController
{
   #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        //  $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //  return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');

        return $this->render('dashboard2/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('RNCP Site E Commerce 2024');
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
         yield MenuItem::linkToCrud('Adress', 'fas fa-location-dot', Adress::class);
         yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
         yield MenuItem::linkToCrud('Products', 'fas fa-suitcase-medical', Products::class);
         yield MenuItem::linkToCrud('cart', 'fas fa-cart-shopping', Cart::class);
         yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('CoursGymnastiqueDouceSenior', 'fas fa-person-walking', CoursGymnastiqueDouceSenior::class);
        yield MenuItem::linkToCrud('Inscription', 'fas fa-registered', Inscription::class);
         yield MenuItem::linkToCrud('RecapDetail', 'fas fa-circle-info', RecapDetails::class);
         yield MenuItem::linkToCrud('Order', 'fas fa-receipt', Order::class);
         yield MenuItem::linkToCrud('Paiement', 'fas fa-money-check', Paiement::class);
         yield MenuItem::linkToUrl('Acceuil','fas fa-home',$this->generateUrl('app_home'));
    }

    // public  function configureUserMenu(UserInterface $user): UserMenu
    // {
    //     if (!$user instanceof User) {
    //         throw new \Exception('wrong user');
    //     } 
    //     return parent:: configureUserMenu($user)
    //         ->setAvatarUrl($user->getAvatarUrl()); // Avatar de l'utilisateur
    // }

     public function configureActions(): Actions
     {
        return parent::configureActions()
        
             ->add(Crud::PAGE_INDEX, Action::DETAIL);

     }
    
    public function configureAssets(): Assets{
        return Assets::new()
            ->addCssFile('css/admin.css');
    }
     


}
