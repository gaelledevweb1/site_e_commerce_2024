<?php

namespace App\Form;

use App\Entity\ArticleBlog;
use App\Entity\CommentsBlog;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentsBlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comments')
            ->add('author')
            ->add('dateCreation',DateType::class,[
                'widget' => 'single_text',
            ])
            ->add('articleBlog', EntityType::class, [
                'class' => ArticleBlog::class,
'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommentsBlog::class,
        ]);
    }
}
