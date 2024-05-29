<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Form\DataTransformer\StringToDateTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Your name cannot contain a number'
                    ]),
                    new Assert\Sequentially([
                        new Assert\NotBlank(),
                        new Assert\Type('string'),
                        new Assert\Length(['min' => 2, 'max' => 20]),
                    ])
                ]
            ])
            ->add('lastName', null, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Your name cannot contain a number'
                    ]),
                    new Assert\Sequentially([
                        new Assert\NotBlank(),
                        new Assert\Type('string'),
                        new Assert\Length(['min' => 2, 'max' => 20]),
                    ])
                ]
            ])

            // ->add('phone',null,['constraints' => [new Assert\Regex(['pattern' => '~^[+]?[(]?[0-9]{3}[)]?[-\\s\\.]?[0-9]{3}[-\\s\\.]?[0-9]{4,6}$~','match'=> true,'message' =>  'Please enter a valid phone number'])]])

            ->add('phone')
            // ->add('birthday', DateType::class, [
            //     'widget' => 'single_text',
            //     'constraints' => [
            //         new Assert\Date()

            //     ],
            // ])

            // ->add('birthday', DateType::class, [
            //     'widget' => 'single_text',
            //     'html5' => false, //  si tu veux utiliser dateType je dois desactiver html5
                // this is actually the default format for single_text
                
            //     'format' =>  'd/m/Y',
            // ])
            // ->get('birthday')
            // ->addModelTransformer(new StringToDateTransformer());
            // ->add('birthday', DateType::class, [
            //     'widget' => 'single_text',
            //     'constraints' => [
            //         new Assert\Date()
                   
            //     ],
            //    ]);

            // ->add('birthday', TextType::class, [
            //         'widget' => 'single_text',
            //         'constraints' => [
            //             new Assert\Date()
                       
            //         ],
            //        ]);


       
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',

                        'max' => 30,
                    ]),
                    // new Assert\Regex([
                    //     'pattern' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/',
                    //     'match' => true,
                    //     'message' => 'Minimum eight characters, at least one upper case English letter, one lower case English letter, one number and one special character'
                    // ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
