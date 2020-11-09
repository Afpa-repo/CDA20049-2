<?php

namespace App\Form;

use App\Entity\Recipes;
use App\Entity\RecipeCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idAuthor')
            ->add('name')
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => RecipeCategory::class,
                // uses the User.username property as the visible option string
                'choice_label' => function ($category) {
                return $category->getName();
                }
            ])

            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,)
            ->add('instructions', CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
            ])
            ->add('picture')
            ->add('ingredients')
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}