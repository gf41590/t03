<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('title')
            ->add('author')
            ->add('participation')
            ->add('contributors')
            ->add('participationsContributors')
            ->add('ministerialPoints')
            ->add('journal')
            ->add('conference')
            ->add('doi')
            ->add('date')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
