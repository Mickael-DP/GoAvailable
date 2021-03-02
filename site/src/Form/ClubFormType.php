<?php

namespace App\Form;

use App\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control',],
                'label' =>'Nom du Club'
            ])

            ->add('dateFondationClub', DateType::class, [
                'attr' => ['class' => 'form-control',],
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                
            ])

            ->add('siteDeCompet',TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' =>'Site de Compétition',
            ])

            ->add('reseauxSocial', UrlType::class,  [
                'attr' => ['class' => 'form-control'],
                'required' => false,
                'label' =>'Twitter'
            ])
            ->add('clubPicture', ClubPictureFormType::class, [
                'required' => false,
                'attr' => ['class' => 'd-none']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
