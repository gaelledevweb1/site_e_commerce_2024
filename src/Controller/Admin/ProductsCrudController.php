<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Products::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
             IdField::new('id')->hideOnForm(),
            IntegerField::new('articleRef'),
            TextField::new('articleName'),
            TextField::new('articleImages'),
            TextField::new('articleThumbnails'),
            IntegerField::new('articleStockQuantity'),
            TextField::new('articleDescription'),
            IntegerField::new('boughtPrice'),
            IntegerField::new('sellPriceHT'),
            IntegerField::new('sellPriceTTC'),
            IntegerField::new('TVA'),
            TextField::new('details'),
            

             AssociationField::new('category'),
        ];
    }
    
}
