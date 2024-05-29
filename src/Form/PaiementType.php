<?php

// namespace App\Form;

// use App\Entity\Paiement;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;
// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;

// class PaiementType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('bankName')
//             ->add('cardName')
//             ->add('cardNumber')
//             ->add('cardNetwork')
//             ->add('cardHoldername')
//             ->add('expirationDate',DateType::class,[
//                 'widget' => 'single_text',
//             ])
//             ->add('CVCCode')
//             ->add('securityCard')
//             ->add('currency');

//             // ->add('paiement', EntityType::class, [
//             //     'class' => Paiement::class,
//             //     'choice_label' => 'id',
//             // ]);

        
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => Paiement::class,
//         ]);
//     }
// }
