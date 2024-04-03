<?php

namespace App\Form;

use App\Entity\Cart;
// use App\Entity\Paiement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('firstName')
            ->add('lastName')
            // ->add('address')
            // ->add('city')
            // ->add('zip')
            // ->add('country')
            ->add('phone')
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
            ])
             ->add('email')
             ->add('password');
            // ->add('confirm_password')
            //  ->add('roles')
            // ->add('cart', EntityType::class, [
            //     'class' => Cart::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('paiement', EntityType::class, [
            //     'class' => Paiement::class,
            //     'choice_label' => 'id',
            // ]);

            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
