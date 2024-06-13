<?php

namespace App\Controller\Admin;

use App\Entity\Inscription;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inscription::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            // TextField::new('title'),
            // TextEditorField::new('description'),
            DateField::new('createdAT'),
            DateField::new('updateAt'),
            dateField::new('birthday'),
            AssociationField::new('user'),
            AssociationField::new('CoursGymnastiqueDouceSenior'),
        ];
    }
   
}
