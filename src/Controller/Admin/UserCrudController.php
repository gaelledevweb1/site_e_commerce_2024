<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController

{   public function __construct(
    public UserPasswordHasherInterface $userPasswordHasher
) {}

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
             yield IdField::new('id')->hideOnForm(),
            yield TextField::new('firstName'),
                
            yield TextField::new('lastName'),
            yield TextField::new('phone'),
            yield DateField::new('birthday'),
            yield EmailField::new('email'),
            // ! le mot de passe n'est pas hasher ici
            yield TextField::new('password'),
            yield BooleanField::new('isVerified')
            ->renderAsSwitch(false),
            yield AssociationField::new('adress'),
            yield AssociationField::new('orders'),
            // yield AssociationField::new('article'),
            // yield AssociationField::new('commentsBlog'),


        ];
    }
    
}

