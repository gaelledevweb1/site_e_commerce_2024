<?php

namespace App\Controller\Admin;


use App\Entity\CoursGymnastiqueDouceSenior;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;

class CoursGymnastiqueDouceSeniorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CoursGymnastiqueDouceSenior::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
             TextField::new('nomCours'),
            TextField::new('description'),
            TextField::new('image'),
            TextField::new('professeur'),
            // objectField::new('detailCours'),
            // DateField::new('birthday'),
            AssociationField::new('inscriptions'),
        ];
    }

    public function InscriptionAuCours(): Response
    {
        
       
        return $this->render('frag/Inscription-Cours-Senior.html.twig');

    }
    

}
