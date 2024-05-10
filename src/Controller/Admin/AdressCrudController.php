<?php

namespace App\Controller\Admin;

use App\Entity\Adress;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adress::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
             IdField::new('id')->hideOnForm(),
            IntegerField::new('number'),
            TextField::new('street'),
            TextField::new('City'),
            IntegerField::new('Zip'),
            TextField::new('Country'),
            
            AssociationField::new('user'),
        ];
    }
    
}
