<?php

namespace App\Form;

use App\Entity\Cart;
use App\Entity\CategoriesBlog;
use App\Entity\Category;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('articleRef')
            ->add('articleName')
            ->add('articleImages')
            ->add('articleThumbnails')
            ->add('articleStockQuantity')
            ->add('articleDescription')
            ->add('boughtPrice')
            ->add('sellPriceHT')
            ->add('sellPriceTTC')
            ->add('TVA')
            ->add('details')
            ->add('categoriesBlog', EntityType::class, [
                'class' => CategoriesBlog::class,
'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])

            
               
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
