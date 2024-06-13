<?php

namespace App\Controller\Admin;

use App\Entity\Order;



use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
             IdField::new('id')->hideOnForm(),
            DateTimeField::new('orderDate')->setFormat('Y-m-d H:i:s'),
            BooleanField::new('paid'),
            TextField::new('status'),
            BooleanField::new('delivered'),
            DateTimeField::new('deliveryDate')->setFormat('Y-m-d H:i:s'),
            TextField::new('deliveryInfo'),
            TextField::new('reference'),
            TextField::new('method'),
            
            
            
            
            
            
            AssociationField::new('user'),
            AssociationField::new('recapDetails'),
        ];
    }
    
}
