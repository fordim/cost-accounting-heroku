<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignUpFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Имя', 'help' => 'Введите ваше имя'])
            ->add('email',EmailType::class, ['label' => 'Электронная почта', 'help' => 'Введите ваш адрес электронной почты'])
            ->add('password_hash', PasswordType::class, ['label' => 'Пароль', 'help' => 'Введите ваш пароль'])
            ->add('save', SubmitType::class, ['label' => 'Зарегистрироватся'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
