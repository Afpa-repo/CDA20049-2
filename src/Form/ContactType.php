<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Wrote your first name']),
                    new Length(['min' => 3]),
                    new Regex(['pattern' => "/[a-zA-Z]+/"]),]
            ])
            ->add('last_name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Wrote your last name']),
                    new Length(['min' => 3]),
                    new Regex(['pattern' => "/[a-zA-Z]+/"]),]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Wrote your email']),
                    new Email(['message' => 'This'.'{{ value }}'.'is not a valid email address.']),]
            ])
            ->add('object', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Wrote your object']),
                    new Length(['min' => 3]),]
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Wrote your comment']),
                    new Length(['min' => 3]),]
            ])
            ->add('post_comment', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
