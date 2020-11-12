<?php

namespace App\Form;

use App\Entity\Recipes;
use App\Entity\RecipeCategory;
use App\Entity\Ingredients;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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

            ->add('instructions', CollectionType::class, [
                // each entry in the array will be an "instruction" field
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])
            ->add('picture')
            ->add('ingredients', CollectionType::class, [
                // each entry in the array will be an "instruction" field
                'entry_type' => IngredientRecipeType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])
        ;
    }

    /*$builder->create('ingredients', FormType::class, ['by_reference' => false])
                    ->add('name', EntityType::class, [
                    // looks for choices from this entity
                    'class' => Ingredients::class,
                    // uses the User.username property as the visible option string
                    'choice_label' => function ($ingredient) {
                        return $ingredient->getName();
                        }
                    ])
                    ->add('quantity', NumberType::class)*/

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}