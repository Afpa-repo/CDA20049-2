<?php

namespace App\Form;

use App\Entity\IngredientCategory;
use App\Entity\Ingredients;
use App\Entity\RecipeCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class IngredientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter the name of the ingredient']),
                    new Length(['min' => 3]),
                    new Regex(['pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/',
                        'message' => 'Check your entry: invalid character']),
                ],
            ])
            ->add('price', null, [
                'required' => false
            ])
            ->add('tempMin', null, [
                'required' => false
            ])
            ->add('tempMax', null, [
                'required' => false
            ])
            ->add('shelfLife', null, [
                'required' => false
            ])
            ->add('picture')
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                     new Image(['maxSize' => '1024k'])
                ],
            ])
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => IngredientCategory::class,
                // uses the User.username property as the visible option string
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredients::class,
        ]);
    }
}
