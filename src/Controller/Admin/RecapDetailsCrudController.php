<?php

namespace App\Controller\Admin;

use App\Entity\RecapDetails;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecapDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RecapDetails::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            // TextField::new('title'),
            // TextEditorField::new('description'),
            IntegerField::new('Quantity'),  
            NumberField::new('price'),
            TextField::new('product'),
            NumberField::new('totalRecap'),
             AssociationField::new('orderProduct'),


        ];
    }
    
}
