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
                // define the visible option string
                'choice_label' => function ($category) {
                return $category->getName();
                }
            ])

            //CollectionType allow a variable amount of inputs
            ->add('instructions', CollectionType::class, [
                // each entry in the array will be an "instruction" field
                'entry_type' => TextType::class,
                //Allow the creation of a new field
                'allow_add' => true,
                //Allow deletion of fields
                'allow_delete' => true,
                'prototype' => true
            ])
            ->add('picture')
            ->add('ingredients', CollectionType::class, [
                // We include the IngredientRecipeType form
                'entry_type' => IngredientRecipeType::class,
                //Allow the creation of a new field
                'allow_add' => true,
                //Allow deletion of fields
                'allow_delete' => true,
                'prototype' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}