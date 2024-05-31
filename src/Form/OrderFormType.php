<?php
namespace App\Form;

use App\Entity\Adress;
use App\Entity\Transporter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // dd($options ['user']);
        
        $user=$options ['user'];
        $builder
            ->add('address', EntityType::class,[
                'class' => Adress::class,
                'choices' => $user->getAdress(),
                
                'choice_label' => function(Adress $adress){
                    return  $adress->getNumber() . ' ' . 
                    $adress->getStreet() . ' ' .
                    $adress->getCity() . ' ' . $adress->getZip() . ' ' . $adress->getCountry();
                    
                },
                'required' => true,
                'multiple' => false,
                'expanded' => false
                
            ])

            ->add('transporter', EntityType::class,[
                'class' => Transporter::class,
                
                'required' => true,
                'multiple' => false,
                'expanded' => true
            
                
                
                
            ]);

            // -> add ('orderDate');

        // Ajoutez vos champs de formulaire ici
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

            'user'=>[]
            // Configurez vos options de formulaire par défaut ici
        ]);

        // Si vous voulez passer l'utilisateur à votre formulaire, vous pouvez le faire ici
        $resolver->setRequired('user');
    }
}
?>