<?php

namespace App\Form;

use App\Entity\LocationSansChauffeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\FormuleSansChauffeur;
use App\Entity\Modele;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class LocSansChauffTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('laFormuleSC', EntityType::class, [            
                'class' => FormuleSansChauffeur::class,            
                'choice_label' => 'libelle',
                'choice_value' => 'id',
                'multiple' => false,
                'expanded' => false,
                'mapped'=>false,
                'required'=>false
            ])
            ->add('modele', EntityType::class, [            
                'class' => Modele::class,            
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'multiple' => false,
                'expanded' => false,
                'mapped'=>false,
                'required'=>false
            ])
            
            
            ->add('Confirmation de la location', SubmitType::class,['attr' => ['class' =>'btn btn-primary']])
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LocationSansChauffeur::class,
        ]);
    }
}