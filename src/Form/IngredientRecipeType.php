<?php

namespace App\Form;

use App\Entity\IngredientRecipe;
use App\Entity\Ingredients;
use App\Entity\Recipes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientRecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('ingredient', EntityType::class, [
                // looks for choices from this entity
                'class' => Ingredients::class,
                // uses the name property as the visible option string
                'choice_label' => function ($ingredient) {
                    return $ingredient->getName();
                }
            ])
            ->add('recipe', EntityType::class, [
                // looks for choices from this entity
                'class' => recipes::class,
                // uses the name property as the visible option string
                'choice_label' => function ($recipe) {
                    return $recipe->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IngredientRecipe::class,
        ]);
    }
}
