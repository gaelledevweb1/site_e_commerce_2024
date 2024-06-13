<?php

namespace App\Form;

use App\Entity\Adress;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class AdressType extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('firstName',TextType::class, ['label' => 'Prénom'])
            ->add('lastName',TextType::class, ['label' => 'Nom'])
            ->add('phone',TextType::class, ['label' => 'Téléphone'])
            ->add('number',IntegerType::class, ['label' => 'Numéro'])
            ->add('street',TextType::class, ['label' => 'Rue'])
            ->add('Zip',IntegerType::class, ['label' => 'Code Postal'])
            ->add('City',TextType::class, ['label' => 'Ville'])
            ->add('Country',TextType::class, ['label' => 'Pays'])
            // ->add('adressLivraison', CollectionType::class, [
            //     'entry_type' => OrderType::class,
            //     'entry_options' => ['label' => 'Adresse de livraison'],
            // ])
           
                
            
       
            
        ;
        
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
            'user'=>[]
        ]);
         // Si vous voulez passer l'utilisateur à votre formulaire, vous pouvez le faire ici
    $resolver->setRequired('user');
    }
   
}
