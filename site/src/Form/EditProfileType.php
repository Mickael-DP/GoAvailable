<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('profilPicture', ProfilPictureFormType::class, [
                'required' => false,
                'attr' => [ 'class' => 'd-none'],
            ])
            ->add('psn', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('gamertag', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('origin', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
