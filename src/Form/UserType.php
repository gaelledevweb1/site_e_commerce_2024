<?php

// namespace App\Form;

// use Symfony\Component\Validator\Constraints as Assert;
// use App\Entity\Cart;
// // use App\Entity\Paiement;
// use App\Entity\User;
// use App\Form\DataTransformer\StringToDateTransformer;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;
// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;

// class UserType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {

//         $builder
//         ->add('firstName', null, [
//             'constraints' => [
//                 new Assert\Regex([
//                     'pattern' => '/\d/',
//                     'match' => false,
//                     'message' => 'Your name cannot contain a number'
//                 ]),
//                 new Assert\Sequentially([
//                     new Assert\NotBlank(),
//                     new Assert\Type('string'),
//                     new Assert\Length(['min' => 2, 'max' => 20]),
//                 ])
//             ]
//         ])
//             ->add('lastName', null, [
//                 'constraints' => [
//                     new Assert\Regex([
//                         'pattern' => '/\d/',
//                         'match' => false,
//                         'message' => 'Your name cannot contain a number'
//                     ]),
//                     new Assert\Sequentially([
//                         new Assert\NotBlank(),
//                         new Assert\Type('string'),
//                         new Assert\Length(['min' => 2, 'max' => 20]),
//                     ])
//                 ]
//             ])
//             // ->add('address')
//             // ->add('city')
//             // ->add('zip')
//             // ->add('country')
//             ->add('phone',null,['constraints' => [new Assert\Regex(['pattern' => '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/','match'=> true,'message' =>  'Please enter a valid phone number'])]])
//             //  ->add('birthday', DateType::class, [
//             //      'widget' => 'single_text',
//             //      'constraints' => [
//             //          new Assert\Date()
                    
//             //      ],
//             //     ]);

//             // ->add('birthday', DateType::class, [
//             //     'widget' => 'single_text',
//             //     'html5' => false, //  si tu veux utiliser dateType je dois desactiver html5
//                 // this is actually the default format for single_text
//             //     'format' =>  'd/m/Y',
//             // ])
//             // ->get('birthday')
//             // ->addModelTransformer(new StringToDateTransformer());
        
             
//              ->add('email')
//              ->add('password');
//             // ->add('confirm_password')
//             //  ->add('roles')
//             // ->add('cart', EntityType::class, [
//             //     'class' => Cart::class,
//             //     'choice_label' => 'id',
//             // ])
//             // ->add('paiement', EntityType::class, [
//             //     'class' => Paiement::class,
//             //     'choice_label' => 'id',
//             // ]);

            
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => User::class,
//         ]);
//     }
// }
