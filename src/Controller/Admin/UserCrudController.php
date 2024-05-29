<?php

namespace App\Controller\Admin;



use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController

{   public function __construct(
    public UserPasswordHasherInterface $userPasswordHasher
) {}

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //          yield IdField::new('id')->hideOnForm(),
    //         yield TextField::new('firstName'),
                
    //         yield TextField::new('lastName'),
    //         yield TextField::new('phone'),
    //         yield DateField::new('birthday'),
    //          yield EmailField::new('email'),
            
    //         // ! le mot de passe n'est pas hasher ici
    //          yield TextField::new('password'),
            
    //         yield BooleanField::new('isVerified')
    //         ->renderAsSwitch(false),
    //         yield AssociationField::new('adress'),
    //         yield AssociationField::new('orders'),
            


    //     ];
        
    // }


    public function configureFields(string $pageName): iterable
    {
        $password = TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => '(Repeat)'],
                'mapped' => false,
            ])
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms();
    
        $fields = [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('phone'),
            // DateField::new('birthday'),
            EmailField::new('email'),
            ChoiceField::new('roles')->setChoices(['ROLE_USER' => 'ROLE_USER', 'ROLE_ADMIN' => 'ROLE_ADMIN'])->allowMultipleChoices(),
            BooleanField::new('isVerified')->renderAsSwitch(false),
            AssociationField::new('adress'),
            AssociationField::new('orders'),
        ];
        $fields[] = $password;
        return $fields;
    }
    

    // !incompatibilite de methode ( signature) entre useradmin (controler ) et easyadmin admin user pour le hashage de mot de passe  je dois choisir entre l'un des deux 
    // public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    // {
    //     $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
    //     return $this->addPasswordEventListener($formBuilder);
    // }

    // public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    // {
    //     $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
    //     return $this->addPasswordEventListener($formBuilder);
    // }

    // private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    // {
    //     return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    // }

    // private function hashPassword() {
    //     return function($event) {
    //         $form = $event->getForm();
    //         if (!$form->isValid()) {
    //             return;
    //         }
    //         $password = $form->get('password')->getData();
    //         if ($password === null) {
    //             return;
    //         }

    //         $hash = $this->userPasswordHasher->hashPassword($this->getUser(), $password);
    //         $form->getData()->setPassword($hash);
    //     };
    // }
    
}




